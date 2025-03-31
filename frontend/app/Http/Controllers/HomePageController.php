<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomePageController extends Controller
{
     public function __invoke()
    {
        $baseUrl = env('APP_BASE_URL');
        
        // Get the districts data
        $districtsResponse = Http::get($baseUrl.'/api/district/get')->json();
        $districtsData = $districtsResponse['data'] ?? [];
    
        // Get the sub-categories data
        $subCategoriesResponse = Http::get($baseUrl.'/api/sub_categories')->json();
        $subCategoriesData = $subCategoriesResponse['data'] ?? [];
        //dd($subCategoriesData);
        // Return the view with both sets of data

        // if(!$subCategoriesData){
        //     return view('errorPages.error500');
        // }
        return view('homePage', [
            'data' => $districtsData,
            'subCategories' => $subCategoriesData,
        ]);
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
        return view('homePageLayout', [
            'data' => $districtsData,
            'subCategories' => $subCategoriesData,
        ]);
    }

    // public function filterData(){
    //     $baseUrl = env('APP_BASE_URL');
        
    //     // Get the districts data
    //     $districtsResponse = Http::get($baseUrl.'/api/district/get')->json();
    //     $districtsData = $districtsResponse['data'] ?? [];
    
    //     // Get the sub-categories data
    //     $subCategoriesResponse = Http::get($baseUrl.'/api/sub_categories')->json();
    //     $subCategoriesData = $subCategoriesResponse['data'] ?? [];
    
    //     // Return the view with both sets of data
    //     return view('home', [
    //         'data' => $districtsData,
    //         'subCategories' => $subCategoriesData,
    //     ]);
    // }
}
