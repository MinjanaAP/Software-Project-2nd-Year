<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class FreeAdController extends Controller
{
    //
    public function locationgetDistricts()
    {
        $baseUrl = env('APP_BASE_URL');
    $response = Http::get($baseUrl.'/api/district/get')->json();
    return view('freeAd10', ['data' => $response['data']]);
    }
    public function getPreviousDetails($subCategory){
        $baseUrl = env('APP_BASE_URL');
        try {
            $url = '';
    
            switch ($subCategory) {
                case 'Mobile phones':
                    $url = $baseUrl . '/api/get-column-names';
                    break;
                case 'Computers':
                    $url = $baseUrl . '/api/get-computer-column-names';
                    break;
                case 'Tvs':
                    $url = $baseUrl . '/api/get-tv-column-names';
                    break;
                case 'Sounds':
                    $url = $baseUrl . '/api/get-sound-column-names';
                    break;
                case 'Home security':
                    $url = $baseUrl . '/api/get-home_security-column-names';
                    break;
                case 'Home Appliances':
                    $url = $baseUrl . '/api/get-home_applicance-column-names';
                    break;
                case 'Cameras':
                    $url = 'http://127.0.0.1:8008/api/get-camera-column-names';
                    break;
                case 'Laptops':
                    $url = 'http://127.0.0.1:8008/api/get-laptop-column-names';
                    break;
                
                default:
                    return response()->json(['message' => 'Invalid subcategory', 'status' => 400]);
            }
    
            $response = Http::get($url)->json();
            return view('freeAd6', ['data' => $response['data']]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => 409]);
        }
    }

    public function getpreviousBrandNames($subCategory)
{
    $baseUrl = env('APP_BASE_URL');
    try {
        $url = '';

            switch ($subCategory) {
                case 'Mobile phones':
                    $url = 'http://127.0.0.1:8008/api/mobile_phone/brands_and_versions';
                    break;
                case 'Computers':
                    $url = 'http://127.0.0.1:8008/api/computer_features/brands_and_versions';
                    break;
                case 'Tvs':
                    $url = 'http://127.0.0.1:8008/api/tv_features/brands_and_versions';
                    break;
                case 'Sounds':
                    $url = 'http://127.0.0.1:8008/api/sound/brands_and_versions';
                    break;
                case 'Home security':
                    $url = 'http://127.0.0.1:8008/api/home_security/brands_and_versions';
                    break;
                case 'Home Appliances':
                    $url = 'http://127.0.0.1:8008/api/home_applicance/brands_and_versions';
                    break;
                case 'Cameras':
                    $url = 'http://127.0.0.1:8008/api/camera/brands_and_versions';
                    break;
                case 'Laptops':
                    $url = 'http://127.0.0.1:8008/api/laptop/brands_and_versions';
                    break;
                default:
                    return response()->json(['message' => 'Invalid subcategory', 'status' => 400]);
            }

        $response = Http::get($url)->json();
        return view('freeAd2', ['data' => $response['data']]);

    } catch (\Throwable $th) {
        return response()->json(['message' => $th->getMessage(), 'status' => 409]);
    }
}

    public function getMobileFeatures()
    {
        $baseUrl = env('APP_BASE_URL');
    $response = Http::get($baseUrl.'/api/mobile_phone_features/features/get')->json();
    return view('freeAd4', ['data' => $response['data']]);
    }

    public function getSubCategories(){
        $baseUrl = env('APP_BASE_URL');
        $subCategories = Http::get($baseUrl.'/api/sub_categories')->json();
        return view('freeAd1',['subCategories' => $subCategories,]);
    }
   

    public function filterData(){
        $baseUrl = env('APP_BASE_URL');
        
        // Get the districts data
        $districtsResponse = Http::get($baseUrl.'/api/district/get')->json();
        $districtsData = $districtsResponse['data'] ?? [];
    
        // Get the sub-categories data
        $subCategoriesResponse = Http::get($baseUrl.'/api/sub_categories')->json();
        $subCategoriesData = $subCategoriesResponse['data'] ?? [];
    
        // Return the view with both sets of data
        return view('layout', [
            'data' => $districtsData,
            'subCategories' => $subCategoriesData,
        ]);
    }

    public function getDetails($subCategory)
    {
        $baseUrl = env('APP_BASE_URL');
        
        try {
            $url = $baseUrl . '/api/getFeatureTableColumns';
    
            // Send the request to the endpoint with the subCategory parameter
            $response = Http::get($url, ['subCategory' => $subCategory])->json();
    
            if (isset($response['data'])) {
                return view('freeAd6', ['data' => $response['data']]);
            } else {
                return view('freeAd6', ['error' => $response['message'] ?? 'Unknown error']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => 409]);
        }
    }
    
    public function getBrandNames($subCategory)
    {
        $baseUrl = env('APP_BASE_URL');
        
        try {
            $url = $baseUrl . '/api/getBrandsAndVersions';
    
            // Send the request to the endpoint with the subCategory parameter
            $response = Http::get($url, ['subCategory' => $subCategory])->json();
    
            if (isset($response['data'])) {
                return view('freeAd2', ['data' => $response['data']]);
            } else {
                return view('freeAd2', ['error' => $response['message'] ?? 'Unknown error']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => 409]);
        }
    }
}
