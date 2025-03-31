<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FreeAdController;
use App\Http\Controllers\bargainAdsController;
use App\Http\Controllers\ProductPageController;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomePageController::class,'__invoke']);


Route::get('/freeAd8', function () {
    return view('freeAd8');
});

Route::get('/freeAd1',[FreeAdController::class,'getSubCategories']);
Route::get('/freeAd3', function () {
    return view('freeAd3');
});




Route::get('/freeAd7', function () {
    return view('freeAd7');
});

// Route::get('/freeAd10', function () {
//     return view('freeAd10');
// });


Route::get('/freeAd10',[FreeAdController::class,'locationgetDistricts']);

Route::get('/freeAd5', function () {
    return view('freeAd5');
});

Route::get('/freeAd11', function () {
    return view('freeAd11');
});

Route::get('/freeAd12', function () {
    return view('freeAd12');
});

Route::get('/freeAd4',[FreeAdController::class,'getMobileFeatures']);

// Route::get('/freeAd3', function () {
//     return view('freeAd3');
// });

Route::get('/freeAd2/{subCategory}', [FreeAdController::class, 'getBrandNames']);
Route::get('/freeAd6/{subCategory}', [FreeAdController::class, 'getDetails']);


Route::get('/emailLogin', function () {
    return view('emailLoging');
})->name('login');



Route::get('/signup', function () {
    return view('createAcc');
});
Route::post('/createAcc', function () {
    return view('welcome');
});

Route::get('/updatePassword', function () {
    return view('updatePassword');
});

Route::get('/forgetPassword', function () {
    return view('forgetPassword');
});

Route::post('/forgetPassword', function () {
    return view('welcome');
});

Route::get('/otpLoging/{user_id}', function ($user_id) {
    return view('otpLoging', ['user_id' => $user_id]);
});

Route::get('/emailRecovery', function (\Illuminate\Http\Request $request) {
    $email = $request->query('email');
    $token = $request->query('token');
    return view('emailRecovery', compact('email', 'token'));
});

Route::post('/emailRecovery', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('createAccmain');
});

Route::get('/test', function () {
    return view('test');
});

Route::post('/', function () {
    return view('test');
});

Route::get('/homePage', [HomePageController::class,'__invoke']);

Route::get('/categoryPage', [HomePageController::class,'__invoke']);




Route::group(['middleware'=>'web','prefix'=>'my'],function(){
    Route::get('/profile',[UserProfileController::class,'__invoke']);
    //Route::get('/myAds',[UserProfileController::class,'getMyAds']);
    Route::get('/ads',function(){
        return view('userProfilePages.myFreeAds');
    });
    Route::get('/bannerAds',function(){
        return view('userProfilePages.myBannerAds');
    });
    Route::get('/favouriteAds',function(){
        return view('userProfilePages.myFavouriteAds');
    });
    Route::get('/adminSupport',function(){
        return view('userProfilePages.adminSupport');
    });
    Route::get('/profile/edit',[UserProfileController::class,'getDistricts']);
    Route::get('/profile/account',[UserProfileController::class,'accountSettings']);
    Route::get('/profile/bargainAds',[UserProfileController::class,'getMyBargainAds']);
    Route::get('/profile/notifications',[UserProfileController::class,'getNotifications']);
});

Route::group(['prefix'=>'admin'],function(){
    Route::get('/dashboard',[AdminDashboardController::class,'__invoke']);
    Route::get('/users',[AdminDashboardController::class,'users']);;
    Route::get('/freeAds',[AdminDashboardController::class,'getFreeAds']);
    Route::get('/freeAdsEdit/{id}',[AdminDashboardController::class,'editFreeAds']);
    Route::get('/seeMoreAds/{status}',[AdminDashboardController::class,'seeMoreAds'])->name('seeMoreAds');
    Route::get('/addFeatures',[AdminDashboardController::class,'addFeatures']);
    Route::get('/reports',[AdminDashboardController::class,'getReports']);
    Route::get('/viewReport/{id}/{adId}',[AdminDashboardController::class,'getReportDetails']);
    Route::get('/editUserReport/{id}',[AdminDashboardController::class,'editUserReport']);
    Route::get('/paidAds',[AdminDashboardController::class,'getPaidAds']);
    Route::get('/editPaidAds/{id}',[AdminDashboardController::class,'editPaidAds']); 
    Route::get('/navBarAd',[AdminDashboardController::class,'getNavBarAds']);
    Route::get('/editFeatures',[AdminDashboardController::class,'editFeatures']);
});
Route::post('/bargainAd1', function () {
    return view('bargainAd1');
});

Route::get('/bargainAd1', function () {
    return view('bargainAd1');
});
Route::get('/bargainAd/{id}',[bargainAdsController::class,'getDetails']);

// Route::get('/bargainAd/{id}', function () {
//     return view('bargainAd1');
// });


Route::get('/footer', function () {
    return view('footer');
});  

Route::get('/productPage1', function () {
    return view('productPage1');
}); 


// todo => s3 image upload
Route::get('/upload', function () {
    return view('s3ImageTesting.upload');
});

Route::get('/images', function () {
    return view('s3ImageTesting.images');
});


// //search function
// Route::get('/layout', function () {
//     return view('layout');
// });

 Route::get('/layout', [FreeAdController::class, 'filterData']);
 Route::get('/homePageLayout', [homepageController::class, 'filterData']);


Route::get('/productPage1/{id}',[ProductPageController::class,'getDetails']);

// Route::get('view-category/{Name}',[homepageController::class,'viewCategory']);

Route::get('/bannerAd1', function () {
    return view('bannerAd1');
});

Route::get('/bannerAd2', function () {
    return view('bannerAd2');
});

Route::get('/addFeatures', [AdminDashboardController::class, 'getSubCategories']);

Route::get('/aboutUs', function () {
    return view('aboutUs');
});
