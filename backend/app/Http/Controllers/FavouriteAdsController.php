<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\FavouriteAds;
use App\Models\free_ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class FavouriteAdsController extends Controller
{

    public function index(){
        $FavouriteAds = FavouriteAds::with('free_ad')->get();
        // return response()->json(['message' => 'success', 'data' => $FavouriteAds], 200);
        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
        }

        $favouriteAds = FavouriteAds::where('user_id', $user->id)->first();
        if ($favouriteAds) {
        // Ensure ad_ids is an array
        $favoriteAdIds = array_values((array)$favouriteAds->ad_ids);
        } else {
        $favoriteAdIds = [];
        }

    return response()->json(['message' => 'success', 'data' => $favoriteAdIds], 200);


       
    }

    public function addFavourite(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'ad_id' => 'required|exists:free_ads,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->errors()->toJson()], 400);
        }

        $adId = $request->input('ad_id');
        $favourite = FavouriteAds::firstOrCreate(
            ['user_id' => $user->id],
            ['ad_ids' => []]
        );



        $adIds = $favourite->ad_ids;
        if (in_array($adId, $adIds)) {
            // Remove the ad from favorites
            $adIds = array_filter($adIds, function($id) use ($adId) {
                return $id != $adId;
            });
            $favourite->ad_ids = $adIds;
            $favourite->save();
            return response()->json(['status' => 200, 'message' => 'Ad removed from favorites', 'data' => $favourite]);
        } 
        
        else {
            // Add the ad to favorites
            $adIds[] = $adId;
            $favourite->ad_ids = $adIds;
            $favourite->save();
            return response()->json(['status' => 201, 'message' => 'Ad added to favorites', 'data' => $favourite]);
        }

    }


    public function show($id)
    {
        // Fetch the FreeAd details from the database
        $free_ad =free_ad::findOrFail($id);

        // Pass the FreeAd details to the view
        return view('FavouriteAds.show', compact('free_ad'));
    }

    public function getFavouriteAds()
        {
            $user = auth()->user();

            if (!$user) {
                return response()->json(['status' => 401, 'message' => 'Unauthorized'], 401);
            }

            $favourite = FavouriteAds::where('user_id', $user->id)->first();

            if (!$favourite) {
                return response()->json(['status' => 404, 'message' => 'No favorites found'], 404);
            }

            $adIds = $favourite->ad_ids;

            // Fetch ad details from free_ads table
            $ads = free_ad::whereIn('id', $adIds)->get();

            return response()->json(['status' => 200, 'message' => 'Favourite ads retrieved successfully', 'data' => $ads], 200);
        }



}







