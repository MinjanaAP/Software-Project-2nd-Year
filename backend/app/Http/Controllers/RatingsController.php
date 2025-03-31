<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;
use App\Models\free_ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    public function index(){
        $ratings = Ratings::with('free_ad')->get();
        return response()->json(['message' => 'success', 'data' => $ratings], 200);
    }

    public function adRatings(Request $request){

        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'ad_id' => 'required|exists:free_ads,id',
            'stars' => 'required|integer|between:1,5'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->errors()->toJson()], 400);
        }

        
        $ratings = Ratings::updateOrCreate(
            ['user_id' => $user->id, 'ad_id' => $request->ad_id],
            ['stars' => $request->stars]
        );
    
        return response()->json(['message' => 'Rating saved successfully', 'data' => $ratings], 201);
    
    }

    //user id ekata ad id tika catch krna
    public function getUserRating($adId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rating = Rating::where('user_id', $user->id)->where('ad_id', $adId)->first();

        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }
        return response()->json(['message' => 'success', 'data' => $rating], 200);
    }


    public function show($id)
    {
        // Fetch the FreeAd details from the database
        $free_ad =free_ad::findOrFail($id);

        // Pass the FreeAd details to the view
        return view('Ratings.show', compact('free_ad'));
    }

    //ad id ekata adala user catch karanna
    public function getRatedUsers($id){

        $users = Ratings::where('ad_id',$id)->get();
       if($users){
        return response()->json(['messagee'=>'Retrived Rated users','data'=>$users,'status'=>201]);
       }else{
        return response()->json(['messagee'=>'Retriving Failed','status'=>404]);
       }

    }

    
}


