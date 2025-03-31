<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function __invoke()
    {
        return view('productPage1');
    } 

    public function getDetails($id)
    {
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl."/api/free_ad/{$id}")->json();
        //dd($response);
        //$view_count = Http::get($baseUrl."/api/getincrementFreeAdCount/{$id}")->json();
        $viewCountIncremented = $this->incrementViewCountIfNeeded($id);

        // if($response['status']===404){
        //     return view('errorPages.error404');
        // }

        if($response['data']['sub_category'] === "Mobile phones" || $response['data']['sub_category'] === "Mobiles"){

            $mobile_features = Http::get($baseUrl."/api/getMobileFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'],'rated_users' => $response['rated_users'],'features' => $mobile_features ['data'],'user_ids'=>$response['user_ids']]);

        }

        if($response['data']['sub_category'] === "Laptops"){
            $laptop_features = Http::get($baseUrl."/api/getLaptopFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'],'features' => $laptop_features ['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);

        }

        if($response['data']['sub_category'] === "Computers"){
            $computer_features = Http::get($baseUrl."/api/getComputerFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'],'features' => $computer_features ['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);

        }

        if ($response['data']['sub_category'] === "Tvs") {
            $tv_features = Http::get($baseUrl."/api/getTVFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'], 'features' => $tv_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);
        }

        if ($response['data']['sub_category'] === "Home Appliances") {
            $home_aplicance_features = Http::get($baseUrl."/api/getHomeAplicanceFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'], 'features' => $home_aplicance_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);
        }
        
        if ($response['data']['sub_category'] === "Home security") {
            $home_security_features = Http::get($baseUrl."/api/getHomeSecurityFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'], 'features' => $home_security_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);
        }

        if ($response['data']['sub_category'] === "Cameras") {
            $camera_features = Http::get($baseUrl."/api/getCameraFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'], 'features' => $camera_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);
        }

        if ($response['data']['sub_category'] === "Sounds") {
            $audio_features = Http::get($baseUrl."/api/getAudioFeatures/{$id}")->json();
            return view('productPage1', ['free_ad' => $response['data'], 'features' => $audio_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids']]);
        }



        else{
            return view('productPage1', ['free_ad' => $response['data'],'user_ids'=>$response['user_ids'],'rated_users' => $response['rated_users']]);
        }

    }

    private function incrementViewCountIfNeeded($id)
    {
        $viewedAds = json_decode(Cookie::get('viewed_ads', '[]'), true);

        if (!in_array($id, $viewedAds)) {
            $baseUrl = env('APP_BASE_URL');
            Http::get($baseUrl . "/api/getincrementFreeAdCount/{$id}"); // Increment view count
            $viewedAds[] = $id;
            Cookie::queue('viewed_ads', json_encode($viewedAds), 60 * 24 * 30); // Store for 30 days
            return true;
        }

        return false;
    }
}
