<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class bargainAdsController extends Controller
{
    public function __invoke()
    {
        return view('bargainAd1');
    } 

    public function getDetails($id)
    {
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl."/api/bargain_ads/{$id}")->json();
        return view('bargainAd1', ['free_ad' => $response['data']]);
    }
}
