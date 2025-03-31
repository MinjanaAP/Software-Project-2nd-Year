<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __invoke(){
        return view('userProfilePages.myProfile');
    }

    public function getMyAds(Request $request)
    {
        $baseUrl = env('APP_BASE_URL');
        $token = session()->get('_token');
        
        
        if ($token) {
            
            try {
                
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($baseUrl.'/api/my/ads');

                
                if ($response->successful()) {
                    
                    $ads = $response->json();

                    
                    return view('userProfilePages.myFreeAds', ['ads' => $ads]);
                } else {
                
                    dd($response->status());
                    abort(500, 'API request failed');
                }
            } catch (\Exception $e) {
                
                abort(500, 'Error occurred while processing request');
            }
        } else {
            
            return redirect('/login');
        }
    }

    // Function to check if the user is logged in
    // private function isLoggedIn()
    // {
    //     return session()->has('token');
    // }

    // // Function to get the access token
    // private function getAccessToken()
    // {
    //     return Session::get('token');
    // }

    public function getDistricts()
    {
        $baseUrl = env('APP_BASE_URL');
    $response = Http::get($baseUrl.'/api/district/get')->json();
    return view('userProfilePages.editProfile', ['data' => $response['data']]);
    }

    public function accountSettings(){
        return view('userProfilePages.accountSettings');
    }

    public function getMyBargainAds(){
        return view('userProfilePages.bargainAds');
    }

    public function getNotifications(){
        return view('userProfilePages.mynotifications');
    }
}
