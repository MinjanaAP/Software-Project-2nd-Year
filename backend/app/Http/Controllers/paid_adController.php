<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\paid_ad;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\DB;

class paid_adController extends Controller
{
    public function index(){
        $paid_ad = paid_ad::all();
        return response()->json(['message'=>'success', 'data'=> $paid_ad],200);

    }

    public function create(){
        try{
            $paid_ad = new paid_ad();
            $paid_ad->name = 'Nimal';
            $paid_ad->address = 'Dialog pvt ldt';
            $paid_ad->number = '0711234567';
            $paid_ad->email = 'abc@gmail.com';
            $paid_ad->url = 'https://dlg.dialog.lk/dialog-television';
            $paid_ad->image = 'image1.jpg';

            // $paid_ad->paid_ad_type_id = 1; //!foreign key
            // $paid_ad->user_id = 1; //!foreign key

            $paid_ad->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $paid_ad], 201);
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

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'url' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'paid_ad_type'=>'required',
        ]);

        try {  

            $paid_ad = new paid_ad();
            $paid_ad->name = $request->name;
            $paid_ad->address = $request->address;
            $paid_ad->number = $request->number;
            $paid_ad->email = $request->email;
            $paid_ad->url = $request->url;

            $image = $request->file('image');
            $path = $image->store('paid_ad_images', 's3');
            $url = Storage::disk('s3')->url($path);

            $paid_ad->image = $url;
            $paid_ad->user_id = $user->id;
            $paid_ad->paid_ad_type=$request->paid_ad_type;

            $paid_ad->save();
            return response()->json(['message' => "Record creation successfully",'data'=>$paid_ad],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

   
    public function edit(Request $request){
        try{
            $paid_ad = paid_ad::findorfail($request->id);
            $paid_ad->fill($request->only([
                'name',
                'address',
                'number',
                'email',
                'url',
                'image',

            ]));


            

            $paid_ad->update();
            return response()->json(['message' => 'Record updated successfully', 'data' => $paid_ad], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }

    // public function delete(Request $request){
    //     try{
    //         $paid_ad = paid_ad::findorfail($request->id);
    //         $paid_ad->delete();
    //         return response()->json(['message'=>'Record deleted successfully'], 201);
    //     }catch(\Exception $e){
    //         return response()->json(['message'=>'Record delete failed', 'data'=>$e->getMessage()], 409);
    //     }
    // }

    public function delete(Request $request){
        try{
            $paid_ad = paid_ad::findOrFail($request->id);
            $imagePath = $paid_ad->image;
            
            // Delete the advertisement record from the database
            $paid_ad->delete();

            // Extract the S3 key from the URL and delete the image from S3
            $pathParts = parse_url($imagePath);
            $s3Key = ltrim($pathParts['path'], '/');
            Storage::disk('s3')->delete($s3Key);

            return response()->json(['message' => 'Record deleted successfully'], 201);
        } catch(\Exception $e){
            return response()->json(['message' => 'Record delete failed', 'data' => $e->getMessage()], 409);
        }
    }


    public function show($id){
    try{
        $paid_ad = paid_ad::findorfail($id);

        if(!empty($paid_ad['image'])){
            $paid_ad['image'] = base64_decode($paid_ad['image']);
        }

        return view ('paid_ad_details',['paid_ad' => $paid_ad]);

    }
    catch(\Exception $e){
        return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()],409);
        }
    }

    public function getSpecificAds(){
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $paid_ad = paid_ad::where('user_id', $user->id)->get();
        if($paid_ad->isEmpty()){
            return response()->json(['message' => 'No paid ads found for the specified user.','status'=>404]);
        }
        return response()->json(['message' => 'Paid ads retrieved successfully', 'data' => $paid_ad,'status'=>201]);
    }

    public function getPaidAds(){
        try {
            $paidAds = DB::table('paid_ads as pa')
                ->join(DB::raw('(SELECT MAX(id) as max_id FROM paid_ads WHERE status = "live" GROUP BY paid_ad_type) as latest_ads'), function($join) {
                    $join->on('pa.id', '=', 'latest_ads.max_id');
                })
                ->select('pa.*')
                ->orderBy('pa.created_at', 'desc')
                ->get();
    
            return response()->json(['message' => 'Record retrieval successful', 'data' => $paidAds, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'error' => $e->getMessage()], 409);
        }
    }
    
    
    

}
