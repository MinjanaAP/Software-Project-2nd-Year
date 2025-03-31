<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\free_ad;
use App\Models\mobile_phone_features;
use App\Models\FavouriteAdsLoad;
use App\Models\Ratings;
use Carbon\Carbon;
use App\Models\Images;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class free_adController extends Controller
{
   
    // public function __construct(){
    //     $this->middleware('auth:api', ['except' => ['index','show']]);
    // }

    public function index(){
       
        $free_ads = free_ad::where('status', 'live')->get();
        return response()->json(['message' => 'success', 'data' => $free_ads,'status'=>201]);
    }

    public function create(){
    try{
        $free_ad = new free_ad();
        $free_ad->title = 'Iphone 11';
        $free_ad->price = 1000;
        $free_ad->image_1 = 'image1.jpg';
        $free_ad->image_2 = 'image2.jpg';
        $free_ad->image_3 = 'image3.jpg';
        $free_ad->image_4 = 'image4.jpg';
        $free_ad->image_5 = 'image5.jpg';
        $free_ad->sub_category = 'Mobile Phones';
        $free_ad->category = 'Electronics';
        $free_ad->description = 'Brand new Iphone 12 for sale';
        $free_ad->view_count = 0;
        $free_ad->save();

        return response()->json(['message' => 'Record created successfully', 'data' => $free_ad], 201);

    }catch(\Exception $e){
        return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
    }
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'sub_category' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'condition' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'description' => 'required|string',
                'district' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'negotiable' => 'required|string',
                // Validate images if present
                'image_1' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_2' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_3' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_4' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_5' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $free_ad = new free_ad();
            $free_ad->title = $request->title;
            $free_ad->price = $request->price;
            $free_ad->sub_category = $request->sub_category;
            $free_ad->category = $request->category;
            $free_ad->condition = $request->condition;
            $free_ad->brand = $request->brand;
            $free_ad->description = $request->description;
            $free_ad->district = $request->district;
            $free_ad->town = $request->town;
            $free_ad->negotiable = $request->negotiable;
            $free_ad->user_id = $user->id;
    
            //* Store images and save URLs to corresponding columns
            for ($i = 1; $i <= 5; $i++) {
                if ($request->hasFile('image_' . $i)) {
                    $image = $request->file('image_' . $i);
                    $path = $image->store('freeAdImages', 's3');
                    $url = Storage::disk('s3')->url($path);
    
                    // Save the URL to the corresponding column
                    $free_ad['image_' . $i] = $url;
                }
            }
    
            $free_ad->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $free_ad, 'id' => $free_ad->id, 'status' => 201]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }


    public function edit(Request $request){
        try{
            $free_ad = free_ad::findorfail($request->id);
            $free_ad->fill($request->only([
                'title',
                'price',
                'image_1',
                'image_2',
                'image_3',
                'image_4',
                'image_5',
                'sub_category',
                'category',
                'description',
                'view_count',
                
            ]));
            $free_ad->update();

            return response()->json(['message' => 'Record updated successfully', 'data' => $free_ad], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete(Request $request){
        try {
            $free_ad = free_ad::findOrFail($request->id);
    
            // AWS S3 client configuration
            $s3Client = new S3Client([
                'version' => 'latest',
                'region'  => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);
    
            // Array to store S3 keys of images to be deleted
            $imageKeys = [];
    
            // Collect all image keys from the free_ad record
            for ($i = 1; $i <= 5; $i++) {
                $imageField = 'image_' . $i;
                if (!empty($free_ad->$imageField)) {
                    $imageUrl = $free_ad->$imageField;
                    // Extract S3 key from URL
                    $imageKeys[] = parse_url($imageUrl, PHP_URL_PATH);
                }
            }
    
            // Delete images from S3
            foreach ($imageKeys as $key) {
                $s3Client->deleteObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key'    => ltrim($key, '/'), // Remove leading slash if any
                ]);
            }
    
            // Delete the free ad record from the database
            $free_ad->delete();
    
            return response()->json(['message' => 'Record deleted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show($id)
    {
        try {
            // Retrieve the free_ad with the specified ID and status, including the related user
            $free_ad = free_ad::where('id', $id)
                ->where('status', 'live')
                ->with('user')
                ->with('favouriteAds')
                ->firstOrFail();
    
            // Check if the free_ad exists
            if ($free_ad) {
                // Check if the id exists in the favouriteAdsLoad table
                $favouriteAdLoad = favouriteAdsLoad::where('ad_id', $id)->first();
    
                // If found, retrieve the user_ids array
                if ($favouriteAdLoad) {
                    $user_ids = $favouriteAdLoad->user_ids;
                    $RatedUsers = Ratings::where('ad_id',$id)->get();
                    
                        if($RatedUsers->isNotEmpty()){
                            $RatedUsers-> makeHidden (['id','created_at','updated_at']);
                            $totalStars = $RatedUsers->sum('stars');
                            $count = $RatedUsers->count();
                            $averageStars = $totalStars / $count;
                            return response()->json([
                                'message' => 'Record retrieved successfully',
                                'data' => $free_ad,
                                'user_ids' => $user_ids,
                                'rated_users'=>$RatedUsers,
                                'avg_stars'=>$averageStars,
                                'status'=>200
                            ]);
                        }else{
                            return response()->json([
                                'message' => 'Record retrieved successfully no any ratings',
                                'data' => $free_ad,
                                'user_ids' => $user_ids,
                                'rated_users'=>null,
                                'avg_stars'=>null,
                                'status'=>200
                            ]); 
                    }
                    
                    
                } else {
                    // return response()->json([
                    //     'message' => 'Record retrieved successfully but not found in favouriteAdsLoad',
                    //     'data' => $free_ad,
                    //     'user_ids' => null
                    // ], 200);
                    $RatedUsers = Ratings::where('ad_id',$id)->get();
                    
                    if($RatedUsers->isNotEmpty()){
                        $RatedUsers-> makeHidden (['id','created_at','updated_at']);
                        $totalStars = $RatedUsers->sum('stars');
                        $count = $RatedUsers->count();
                        $averageStars = $totalStars / $count;
                        return response()->json([
                            'message' => 'Record retrieved successfully but not found in favouriteAdsLoad',
                            'data' => $free_ad,
                            'rated_users'=>$RatedUsers,
                            'avg_stars'=>$averageStars,
                            'user_ids' => null,
                            'status'=>200
                        ]);
                    }else{
                        return response()->json([
                            'message' => 'Record retrieved successfully but not favourite and not Ratings',
                            'data' => $free_ad,
                            'user_ids' => null,
                            'rated_users'=>null,
                            'avg_stars'=>null,
                            'status'=>200
                        ]); 
                }
                }
            } else {
                return response()->json(['message' => 'Record not found', 'data' => null, 'status'=>404]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage(), 'id' => $id,'status'=>404]);
        }
    }
    

    
    
    

    public function getLatestAds() {
        try {
            // Fetch the latest 6 ads ordered by created_at in descending order
            $latest_ads = free_ad::orderBy('created_at', 'desc')->where('status','live')->take(6)->get();
            
            return response()->json(['message' => 'Latest ads retrieved successfully', 'data' => $latest_ads,'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve latest ads', 'data' => $e->getMessage()], 409);
        }
    }


   
    
    public function getSubCategoryAds($Name){
        try{
            $subCategory_ads = free_ad::where('sub_category', $Name)->where('status','live')->get();
            return response()->json(['message' => 'Ads retrieved successfully', 'data' => $subCategory_ads,'status' => 200]);
        }catch(\Exception $e){
            return response()->json(['message' => 'Failed to retrieve ads', 'data' => $e->getMessage()], 409);
        }
    }   

    public function filterAds($district = null, $town = null, $priceRange = null, $category = null)
{
    try {
        $query = free_ad::query();

        if ($district && $district !== 'all') {
            $query->where('district', $district);
        }

        if ($town && $town !== 'all') {
            $query->where('town', $town);
        }

        if ($priceRange && $priceRange !== 'all') {
            
            list($minPrice, $maxPrice) = explode('-', $priceRange);
            $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }

        if ($category && $category !== 'all') {
            $query->where('sub_category', $category);
        }

        $ads = $query->where('status', 'live')->get();

        return response()->json(['message' => 'Ads retrieved successfully', 'data' => $ads, 'status' => 200]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to retrieve ads', 'data' => $e->getMessage()], 409);
    }
}

    
public function search(Request $request) {
    try {
        $searchText = $request->search_text;
        $freeAds = free_ad::where(function($query) use ($searchText) {
            $query->where('title', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('brand', 'LIKE', '%' . $searchText . '%');
        })->where('status', 'live')
            ->paginate(9);
            
        return response()->json(['message' => 'Record retrieved successfully', 'data' => $freeAds, 'status' => 200]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
    }
}



    public function pagination(){
        try {
            // Fetch 'live' ads, ordered by 'created_at' in descending order, and paginate the results (6 per page)
            $free_ad = free_ad::where('status', 'live')->inRandomOrder()->paginate(6);
    
            // Return a JSON response with the retrieved ads
            return response()->json(['message' => 'success', 'data' => $free_ad], 200);
        } catch (\Exception $e) {
            // Log the exception (optional but recommended for debugging purposes)
            Log::error('Failed to paginate ads', ['error' => $e->getMessage()]);
    
            // Return a JSON response with the error message and status code
            return response()->json(['message' => 'Failed to paginate ads', 'data' => $e->getMessage(), 'status' => 409], 409);
        }
    }
    


   

    public function LatestAdsBasedOnSubCategory()
    {
        try {
            // Fetch the latest ad for each sub_category
            $latest_ads = free_ad::orderBy('created_at', 'desc')
                                ->where('status','live')
                                ->get()
                                ->groupBy('sub_category')
                                ->map(function ($group) {
                                    return $group->first();
                                })
                                ->values();

            return response()->json(['message' => 'Latest ads retrieved successfully', 'data' => $latest_ads, 'status' => 200]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Failed to retrieve latest ads', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve latest ads', 'data' => $e->getMessage(), 'status' => 409], 409);
        }
    

}


public function AdsByTitleAndBrand(Request $request) {
    try {
        // Get the title, brand, and id from the request
        $title = $request->input('title');
        $brand = $request->input('brand');
        $id = $request->input('id');
        $subCategory = $request->input('sub_category');

        $query = free_ad::where('status', 'live');

        if ($title) {
            $titleKeywords = explode(' ', $title);
            $query->where(function($q) use ($titleKeywords) {
                foreach ($titleKeywords as $keyword) {
                    $q->orWhere('title', 'like', '%' . $keyword . '%');
                }
            });
        }

        if ($brand) {
            $brandKeywords = explode(' ', $brand);
            $query->where(function($q) use ($brandKeywords) {
                foreach ($brandKeywords as $keyword) {
                    $q->orWhere('brand', 'like', '%' . $keyword . '%');
                }
            });
        }

        if ($id) {
            $query->where('id', '!=', $id);
        }

        // Order by created_at in descending order and paginate the results (6 per page)
        $ads = $query->orderBy('created_at', 'desc')->paginate(6);

        return response()->json(['message' => 'success', 'data' => $ads, 'status' => 200]);
    } catch (\Exception $e) {
        Log::error('Failed to retrieve ads', ['error' => $e->getMessage()]);

        return response()->json(['message' => 'Failed to retrieve ads', 'data' => $e->getMessage(), 'status' => 409]);
    }
}


    public function incrementFreeAdCount($id){
        try {
            $free_ad = free_ad::where('id',$id)->first();
            $free_ad->increment('view_count');

            return response()->json(['message' => 'Record retrieved successfully','data'=>$free_ad['view_count']], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed',], 409);
        }
    }


    public function popularAdsByViewCount() {
        try {
            // Retrieve all ads ordered by view_count in descending order
            $free_ads = free_ad::orderBy('view_count', 'desc')->where('status','live')->paginate(6);
    
            return response()->json(['message' => 'Records retrieved successfully', 'data' => $free_ads], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Records retrieval failed', 'error' => $e->getMessage()], 409);
        }
    }


    public function SubCategoryAdsForProductPage($Name,Request $request){
        try{
            $subCategory_ads = free_ad::where('sub_category', $Name)->where('status','live');

            if ($request->id) {
                $subCategory_ads->where('id', '!=', $request->id);
            }

            $subCategory_ads = $subCategory_ads ->inRandomOrder()->paginate(6);
            return response()->json(['message' => 'Ads retrieved successfully', 'data' => $subCategory_ads,'status' => 200]);
        }catch(\Exception $e){
            return response()->json(['message' => 'Failed to retrieve ads', 'data' => $e->getMessage()], 409);
        }
    }   
    


}
