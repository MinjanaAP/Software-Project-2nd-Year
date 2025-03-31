<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nav_bar_ad;

class navBarAdController extends Controller
{
    
    public function store(Request $request)
    {

        try {
            // Validate the request data
            $request->validate([
                'description' => 'required|string',
            ]);
    
            $navBarAd = new nav_bar_ad();
            $navBarAd->description = $request->description;


            $navBarAd->save();
            return response()->json(['message' => 'Record created successfully', 'status' => 200, 'data' => $navBarAd]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record creation failed', 'status' => 409, 'data' => $e->getMessage()]);
        }
    }



        public function getNavBarAds(){

            try {

                $navBarAd = nav_bar_ad::orderBy('created_at', 'desc')->first();
        
                return response()->json(['message' => 'Record retrieval successful', 'data' =>  $navBarAd, 'status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Record retrieval failed', 'error' => $e->getMessage()], 409);
            }
        }





}
