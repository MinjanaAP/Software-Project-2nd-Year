<?php

namespace App\Http\Controllers;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class AdminDashboardController extends Controller
{
    public function __invoke(){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl.'/api/admin/getCounts')->json();
        // dd($response);
        return view('adminPanel.dashboard', ['response' => $response, ]);
    }

    public function users(){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl.'/api/admin/getUserDetails')->json();
        $adminUsers = Http::get($baseUrl.'/api/admin/getAdminUsers')->json();
        return view('adminPanel.users',['response' => $response,'adminUsers'=>$adminUsers]);
    }


    public function getFreeAds(){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl.'/api/district/get')->json();
        $subCategoriesResponse = Http::get($baseUrl.'/api/sub_categories')->json();
        $subCategoriesData = $subCategoriesResponse['data'] ?? [];
        return view('adminPanel.freeAds', ['data' => $response['data'],'subCategories' => $subCategoriesData,]);
    
    }

    public function editFreeAds($id){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl."/api/admin/getSpecificAds/{$id}")->json();
        //dd($response);
        return view('adminPanel.freeAdsEdit',['ad' => $response['data'],'user'=>$response['data']['user']]);
    }

    public function seeMoreAds($status, Request $request) {
        $baseUrl = env('APP_BASE_URL');
        $page = $request->input('page', 1);
        $response = Http::get("{$baseUrl}/api/admin/getAllAdsByStatus/{$status}?page={$page}")->json();
        $ads = $response['data']['data'];
        $pagination = [
            'current_page' => $response['data']['current_page'],
            'prev_page_url' => $response['data']['prev_page_url'],
            'next_page_url' => $response['data']['next_page_url'],
            'links' => $response['data']['links']
        ];
    
        return view('adminPanel.seeMoreAds', [
            'status' => $status,
            'ads' => $ads,
            'pagination' => $pagination 
        ]);
    }

    
    public function addFeatures(){
        $response = Http::get('http://127.0.0.1:8008/api/district/get')->json();
        //dd($response);
        

        $baseUrl = env('APP_BASE_URL');
        $subCategory = Http::get($baseUrl.'/api/sub_categories')->json();
        // dd($subCategory['data']);
        return view('adminPanel.addFeatures',['subCategories' => $subCategory['data'],'data'=>$response['data']]);    
    }

    public function getReports(){
        return view('adminPanel.reports');
    }

    public function getReportDetails($reportId,$id)
    {
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl."/api/free_ad/{$id}")->json();
        $report = Http::get($baseUrl."/api/report/index/{$reportId}")->json();
        //$view_count = Http::get($baseUrl."/api/getincrementFreeAdCount/{$id}")->json();
        // dd($response);
        if($response['data']['sub_category'] === "Mobile phones" || $response['data']['sub_category'] === "Mobiles"){

            $mobile_features = Http::get($baseUrl."/api/getMobileFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'],'rated_users' => $response['rated_users'],'features' => $mobile_features ['data'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);

        }

        if($response['data']['sub_category'] === "Laptops"){
            $laptop_features = Http::get($baseUrl."/api/getLaptopFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'],'features' => $laptop_features ['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);

        }

        if($response['data']['sub_category'] === "Computers"){
            $computer_features = Http::get($baseUrl."/api/getComputerFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'],'features' => $computer_features ['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);

        }

        if ($response['data']['sub_category'] === "Tvs") {
            $tv_features = Http::get($baseUrl."/api/getTVFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'], 'features' => $tv_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);
        }

        if ($response['data']['sub_category'] === "Home Appliances") {
            $home_aplicance_features = Http::get($baseUrl."/api/getHomeAplicanceFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'], 'features' => $home_aplicance_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);
        }
        
        if ($response['data']['sub_category'] === "Home security") {
            $home_security_features = Http::get($baseUrl."/api/getHomeSecurityFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'], 'features' => $home_security_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);
        }

        if ($response['data']['sub_category'] === "Cameras") {
            $camera_features = Http::get($baseUrl."/api/getCameraFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'], 'features' => $camera_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);
        }

        if ($response['data']['sub_category'] === "Sounds") {
            $audio_features = Http::get($baseUrl."/api/getAudioFeatures/{$id}")->json();
            return view('adminPanel.viewReport', ['free_ad' => $response['data'], 'features' => $audio_features['data'],'rated_users' => $response['rated_users'],'user_ids'=>$response['user_ids'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);
        }



        else{
            return view('adminPanel.viewReport', ['free_ad' => $response['data'],'user_ids'=>$response['user_ids'],'rated_users' => $response['rated_users'],'reportData'=>$report['report'],'reportedUser'=>$report['user']]);
        }

    }

    public function editUserReport($id){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl."/api/report/index/{$id}")->json();
        return view('adminPanel.editUserReport',['report' => $response['report'],'user'=>$response['user']]);
    }

    public function getPaidAds(){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl.'/api/admin/getPaidAds')->json();
        return view('adminPanel.paidAds');
    }
    
    public function editPaidAds($id){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl."/api/admin/getSpecificPaidAds/{$id}")->json();
        //dd($response);
        return view('adminPanel.editPaidAd',['ad' => $response['data'],'user'=>$response['user']]);
    }

    public function editFeatures(){
        $baseUrl = env('APP_BASE_URL');
        $response = Http::get($baseUrl.'/api/admin/editFeatures')->json();
        return view('adminPanel.editFeatures');

        $baseUrl = env('APP_BASE_URL');
        $subCategory = Http::get($baseUrl.'/api/sub_categories')->json();
        // dd($subCategory['data']);
        return view('adminPanel.editFeatures',['subCategories' => $subCategory['data'],'data'=>$response['data']]); 
    }

    public function getNavBarAds(){
        return view('adminPanel.navBarAd');
    }
}
