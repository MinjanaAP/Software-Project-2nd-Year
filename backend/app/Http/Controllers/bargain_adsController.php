<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bargain_ads;
use App\Models\free_ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class bargain_adsController extends Controller
{
    public function index(){
        $bargain_ads = bargain_ads::with('free_ad')->get();
        return response()->json(['message' => 'success', 'data' => $bargain_ads], 200);
    }

    public function store(Request $request)
{
        $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $validator = Validator::make($request->all(), [
        'bargain_price' => 'required|numeric', 
        'description' => 'required|string',
        'free_ad_id' => 'required|exists:free_ads,id', 
    ]);

    
    if ($validator->fails()) {
        return response()->json($validator->errors()->toJson(), 400);
    }

    try {
        
        $bargainAd = new bargain_ads(); 
        $bargainAd->user_id = $user->id;
        $bargainAd->bargain_price = $request->bargain_price;
        $bargainAd->description = $request->description;
        $bargainAd->free_ad_id = $request->free_ad_id;
        $bargainAd->save();

        // Return a success response
        return response()->json(['message' => 'Bargain price added successfully', 'data' => $bargainAd], 201);

    } catch (\Exception $e) {
        // Return an error response if something goes wrong
        return response()->json(['message' => 'Bargain price creation failed', 'error' => $e->getMessage()], 500);
    }
}

    
    public function show($id)
    {
        // Fetch the FreeAd details from the database
        $free_ad =free_ad::findOrFail($id);

        // Pass the FreeAd details to the view
        return view('bargain_ads.show', compact('free_ad'));
    }
}
