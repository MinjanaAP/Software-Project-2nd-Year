<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bargain_ads;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\free_ad;
use App\Models\user_notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class userController extends Controller
{
    // public function index(){
    //     $user = user::all(); //get all users
    //     return response()->json(['message' => 'success', 'data' => $user], 200);

    // }

    public function index(){
        try {
            $user = user::all(); //get all users
            return response()->json(['message' => 'success', 'data' => $user], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function create(){
        try{
            $user = new user();
            $user->email = 'user name';
            $user->password = 'user password';
            $user-> first_name  = 'user  first_name ';
            $user->last_name = 'user last_name';
            $user->town = 'user town';
            $user->district = 'user district';
            $user->telephone_no_1 = 'user telephone_no_1';
            $user->telephone_no_2 = 'user telephone_no_2';
            
            // $user->user_role_id  = 1234; //foreign key


            $user->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $user], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $user = new user();
            $user->email = $request->email;
            $user->password = $request->password;
            $user->first_name  = $request->first_name;
            $user->last_name = $request->last_name;
            $user->town = $request->town;
            $user->district = $request->district;
            $user->telephone_no_1 = $request->telephone_no_1;
            $user->telephone_no_2 = $request->telephone_no_2;
            
            // $user->user_role_id  = 1234; //foreign key

            $user->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $user], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    
        public function edit(Request $request){
            try{
                $user = user::findorfail($request->id);
                $user->fill($request->only([
                    'email','password','first_name','last_name','town','district','telephone_no_1','telephone_no_2']));
                
                $user->update();
                return response()->json(['message' => 'Record updated successfully', 'data' => $user], 201);
            }catch(\Exception $e){
                return response()->json(['message' => 'Record updated failed', 'data' => $e->getMessage()], 409);
            }
        }
        
        
        public function delete(Request $request){
            try{
                $user = user::findorfail($request->id);
                
                $user->delete();
                return response()->json(['message' => 'Record deleted successfully', 'data' => $user], 201);
            }catch(\Exception $e){
                return response()->json(['message' => 'Record deleted failed', 'data' => $e->getMessage()], 409);
            }
        }


        public function show($id){
            try{
                $user = user::findorfail($id);

                
                return response()->json(['message' => 'Record retrive successfully', 'data' => $user], 201);
            }catch(\Exception $e){
                return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
            }
        }

        //! function for get free Ads fro each user by user id

        public function getFreeAds(){

            $user = Auth::user();
    
            if ($user) {
                $user_id = $user->id;
                $free_ads = Free_ad::orderBy('created_at', 'desc')->where('user_id', $user_id)->get();
            
                if ($free_ads->isEmpty()) {
                    return response()->json(['message' => 'No free ads found for the specified user.'], 404);
                }
    

            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            return response()->json(['message' => 'success', 'data' => $free_ads], 200);
        }

        public function getMyBargainAds() {
            $user = Auth::user();
            if ($user) {
                $user_id = $user->id;
                
                $bargainAds = bargain_ads::where('user_id', $user_id)->with('free_ad')->get();
                
                if ($bargainAds->isEmpty()) {
                    return response()->json(['message' => 'No bargain ads found for the specified user.'], 404);
                }

                return response()->json(['message' => 'success', 'data' => $bargainAds], 200);
        
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        public function getBargainPriceForMyAds()
        {
            $user = Auth::user();
            if ($user) {
                // Get all free_ad IDs for the current user
                $free_ad_ids = free_ad::where('user_id', $user->id)->pluck('id');

                // Get all bargain ads for the free_ad IDs and include free_ad and user details
                $bargainAds = bargain_ads::whereIn('free_ad_id', $free_ad_ids)
                    ->with(['free_ad', 'user']) // Eager load freeAd and user relationships
                    ->get();

                if ($bargainAds->isEmpty()) {
                    return response()->json(['message' => 'No bargain ads found for the specified user.'], 404);
                }

                return response()->json(['message' => 'success', 'data' => $bargainAds], 200);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }


        //?getNotifications

        public function getNotifications(){
            $user = Auth::user();
            if ($user) {
                $user_id = $user->id;
                $notifications = user_notification::where('user_id', $user_id)->where('is_read',0)->orderBy('created_at', 'desc')->get();
                
                if ($notifications->isEmpty()) {
                    return response()->json(['message' => 'No notifications found for the specified user.'], 404);
                }
                
                return response()->json(['message' => 'success', 'data' => $notifications, 'status' => 200]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        public function addMobileNumber(Request $request){
            $user = Auth::user();
            try{
                $user->telephone_no_1 = $request->telephone_no_1;
                $user->telephone_no_2 = $request->telephone_no_2;
    
                $user->save();
                return response()->json(['message' => 'Record created successfully', 'data' => $user], 201);
            }catch(\Exception $e){
                return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
            }
        }
    

    public function check(){
        Artisan::call("passport:install");
    }
        
    public function markAsRead(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:user_notifications,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'data' => $validator->errors(), 'status' => 400]);
        }

        $notification = user_notification::find($request->id);
        $notification->is_read = 1;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read', 'data' => $notification, 'status' => 200]);
    }


















}
