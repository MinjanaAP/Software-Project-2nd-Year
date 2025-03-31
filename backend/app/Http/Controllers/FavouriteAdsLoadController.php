<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavouriteAdsLoad;
use App\Models\free_ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavouriteAdsLoadController extends Controller
{
    public function index(){
        $FavouriteAdsLoad = FavouriteAdsLoad::with('free_ad')->get();
        return response()->json(['message' => 'success', 'data' => $FavouriteAdsLoad], 200);
       
    }
    
    public function store(Request $request)
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
        $favourite = FavouriteAdsLoad::firstOrCreate(
            ['ad_id' => $adId],
            ['user_ids' => []]
        );

        $userIds = $favourite->user_ids;

        if (in_array($user->id, $userIds)) {
            // Remove the user from favorites
            $userIds = array_filter($userIds, function($id) use ($user) {
                return $id != $user->id;
            });
            $favourite->user_ids = $userIds;
            $favourite->save();
            return response()->json(['status' => 200, 'message' => 'User removed from favorites', 'data' => $favourite]);
        } else {
            // Add the user to favorites
            $userIds[] = $user->id;
            $favourite->user_ids = $userIds;
            $favourite->save();
            return response()->json(['status' => 201, 'message' => 'User added to favorites', 'data' => $favourite]);
        }
    }
}









