<?php

use App\Models\free_ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\free_adController;
use App\Http\Controllers\paid_ad_typeController;
use App\Http\Controllers\paid_adController;
use App\Http\Controllers\ComputerFeaturesController;
use App\Http\Controllers\HomeAplicanceFeaturesController;
use App\Http\Controllers\HomeSecurityFeaturesController;
use App\Http\Controllers\TvFeaturesController;
use App\Http\Controllers\userController;
use App\Http\Controllers\user_roleController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\site_visitorsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\MobilePhoneFeaturesController;
use App\Http\Controllers\AudioFeaturesController;
use App\Http\Controllers\HealthsItemFeaturesController;
use App\Http\Controllers\CameraFeaturesController;
use App\Http\Controllers\LaptopFeaturesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\bargain_adsController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ImageUploadController;
use App\Models\District;
use App\Models\Town;
use App\Http\Controllers\FavouriteAdsController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\Auth\SocialiteController;

use App\Http\Controllers\userReportController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FavouriteAdsLoadController;
use App\Http\Controllers\navBarAdController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//? Free_ad APIs
Route::post('/free_adCreate', [free_adController::class, 'store']);
Route::get('/free_adCreate', [free_adController::class, 'index']);
Route::put('/free_adCreate', [free_adController::class, 'edit']);
Route::delete('/free_adCreate', [free_adController::class, 'delete']);
Route::get('/free_ad/{id}', [free_adController::class, 'show']);
Route::get('/free_ad/admin/{id}',[free_adController::class,'FreeAdShow']);
Route::get('/latest-ads',[free_adController::class, 'getLatestAds']);
Route::get('/sub_category_ads/{Name}',[free_adController::class, 'getSubCategoryAds']);
Route::get('/filterAds/{district}/{town}/{priceRange}/{category}',[free_adController::class, 'filterAds']);
Route::get('/getPaginationAds',[free_adController::class, 'pagination']);
Route::get('/getLatestAdsBasedOnSubCategory',[free_adController::class, 'LatestAdsBasedOnSubCategory']);
Route::get('/getAdsByTitleAndBrand',[free_adController::class, 'AdsByTitleAndBrand']);
Route::get('/getincrementFreeAdCount/{id}',[free_adController::class, 'incrementFreeAdCount']);
Route::get('/getpopularAdsByViewCount',[free_adController::class, 'popularAdsByViewCount']);
Route::get('/getSubCategoryAdsForProductPage/{Name}',[free_adController::class, 'SubCategoryAdsForProductPage']);




Route::get('/search', [free_adController::class, 'search']);

//? paid_ad APIs
// Route::post('/paid_adCreate',[paid_adController::class,'store']);
route::get('/paid_adCreate',[paid_adController::class,'index']);
route::put('/paid_adCreate',[paid_adController::class,'edit']);
route::delete('/paid_adCreate',[paid_adController::class,'delete']);
Route::get('/get_latest_paid_ads',[paid_adController::class,'getPaidAds']);


//? paid_ad_type APIs
Route::post('/paid_ad_typeCreate',[paid_ad_typeController::class,'store']);
Route::get('/paid_ad_typeCreate',[paid_ad_typeController::class,'index']);
Route::put('/paid_ad_typeCreate',[paid_ad_typeController::class,'edit']);
Route::delete('/paid_ad_typeCreate',[paid_ad_typeController::class,'delete']);
Route::get('/paid_ad_typeCreate/{id}',[paid_ad_typeController::class,'show']);


//report APIs
Route::post('/reportCreate',[reportController::class,'store']);
Route::get('/reportCreate',[reportController::class,'index']);
Route::put('/reportCreate',[reportController::class,'edit']);
Route::delete('/reportCreate',[reportController::class,'delete']);

//user APIs
route::post('/userCreate', [userController::class,'store']);
route::get('/userCreate', [userController::class,'index']);
route::put('/userCreate', [userController::class,'edit']);
route::delete('/userCreate', [userController::class,'delete']);
Route::get('/userCreate/{id}', [UserController::class, 'show']);

//user_role APIs
route::post('/user_roleCreate', [user_roleController::class,'store']);
route::get('/user_roleCreate', [user_roleController::class,'index']);
route::put('/user_roleCreate', [user_roleController::class,'edit']);
route::delete('/user_roleCreate', [user_roleController::class,'delete']);
Route::get('/user_roleCreate/{id}', [user_roleController::class, 'show']);
//computer_features
Route::post('/computer_features',[ComputerFeaturesController::class,'store']);
Route::get('/computer_features', [ComputerFeaturesController::class, 'index']);
Route::put('/computer_features', [ComputerFeaturesController::class, 'edit']);
Route::delete('/computer_features', [ComputerFeaturesController::class, 'delete']);
Route::post('/computer_features/brand_name',[ComputerFeaturesController::class,'addBrandNames']);
Route::post('/computer_features/version',[ComputerFeaturesController::class,'addVersions']);
// Route to fetch brands and their versions
Route::get('/computer_features/brands_and_versions', [ComputerFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-computer-column-names', [ComputerFeaturesController::class, 'getColNames']);
Route::get('/getComputerFeatures/{id}',[ComputerFeaturesController::class, 'getComputerFeatures']);


//tv_features
Route::post('/tv_features',[TvFeaturesController::class,'store']);
Route::get('/tv_features', [TvFeaturesController::class, 'index']);
Route::put('/tv_features', [TvFeaturesController::class, 'edit']);
Route::delete('/tv_features', [TvFeaturesController::class, 'delete']);
Route::get('/getTVFeatures/{id}',[TvFeaturesController::class, 'getTVFeatures']);


Route::post('/tv_features/brand_name',[TvFeaturesController::class,'addBrandNames']);
Route::post('/tv_features/version',[TvFeaturesController::class,'addVersions']);
// Route to fetch brands and their versions
Route::get('/tv_features/brands_and_versions', [TvFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-tv-column-names', [TvFeaturesController::class, 'getColNames']);

//home_aplicance_features
Route::post('/home_aplicance_features',[HomeAplicanceFeaturesController::class,'store']);
Route::get('/home_aplicance_features', [HomeAplicanceFeaturesController::class, 'index']);
Route::put('/home_aplicance_features', [HomeAplicanceFeaturesController::class, 'edit']);
Route::delete('/home_aplicance_features', [HomeAplicanceFeaturesController::class, 'delete']);
Route::post('/home_applicance/brand_name',[HomeAplicanceFeaturesController::class,'addBrandNames']);
Route::post('/home_applicance/version',[HomeAplicanceFeaturesController::class,'addVersions']);
// Route to fetch brands and their versions
Route::get('/home_applicance/brands_and_versions', [HomeAplicanceFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-home_applicance-column-names', [HomeAplicanceFeaturesController::class, 'getColNames']);

Route::get('/getHomeAplicanceFeatures/{id}',[HomeAplicanceFeaturesController::class, 'getHomeAplicanceFeatures']);


//home_security_features
Route::post('/home_security_features',[HomeSecurityFeaturesController::class,'store']);
Route::get('/home_security_features', [HomeSecurityFeaturesController::class, 'index']);
Route::put('/home_security_features', [HomeSecurityFeaturesController::class, 'edit']);
Route::delete('/home_security_features', [HomeSecurityFeaturesController::class, 'delete']);
Route::post('/home_security/brand_name',[HomeSecurityFeaturesController::class,'addBrandNames']);
Route::post('/home_security/version',[HomeSecurityFeaturesController::class,'addVersions']);
// Route to fetch brands and their versions
Route::get('/home_security/brands_and_versions', [HomeSecurityFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-home_security-column-names', [HomeSecurityFeaturesController::class, 'getColNames']);

Route::get('/getHomeSecurityFeatures/{id}',[HomeSecurityFeaturesController::class, 'getHomeSecurityFeatures']);


//laptop_features
Route::post('/laptop_features',[LaptopFeaturesController::class,'store']);
Route::get('/laptop_features', [LaptopFeaturesController::class, 'index']);
Route::put('/laptop_features', [LaptopFeaturesController::class, 'edit']);
Route::delete('/laptop_features', [LaptopFeaturesController::class, 'delete']);
Route::post('/laptop/brand_name',[LaptopFeaturesController::class,'addBrandNames']);
Route::post('/laptop/version',[LaptopFeaturesController::class,'addVersions']);
Route::get('/getLaptopFeatures/{id}',[LaptopFeaturesController::class, 'getLaptopFeatures']);


Route::get('/laptop/brands_and_versions', [LaptopFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-laptop-column-names', [LaptopFeaturesController::class, 'getColNames']);

//camera_features
Route::post('/camera_features',[CameraFeaturesController::class,'store']);
Route::get('/camera_features', [CameraFeaturesController::class, 'index']);
Route::put('/camera_features', [CameraFeaturesController::class, 'edit']);
Route::delete('/camera_features', [CameraFeaturesController::class, 'delete']);
Route::post('/camera/brand_name',[CameraFeaturesController::class,'addBrandNames']);
Route::post('/camera/version',[CameraFeaturesController::class,'addVersions']);
// Route to fetch brands and their versions
Route::get('/camera/brands_and_versions', [CameraFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-camera-column-names', [CameraFeaturesController::class, 'getColNames']);

Route::get('/getCameraFeatures/{id}',[CameraFeaturesController::class, 'getCameraFeatures']);


//site_visitors
Route::post('/site_visitors',[site_visitorsController::class,'store']);
Route::get('/site_visitors',[site_visitorsController::class,'index']);
Route::put('/site_visitors',[site_visitorsController::class,'edit']);
Route::delete('/site_visitors',[site_visitorsController::class,'delete']);
Route::get('/site_visitors/{id}',[site_visitorsController::class,'show']);

Route::post('/categories',[CategoriesController::class,'store1  ']);
Route::get('/categories',[CategoriesController::class,'index']);
Route::put('/categories',[CategoriesController::class,'edit']);
Route::delete('/categories',[CategoriesController::class,'delete']);
Route::get('/categories/{id}',[CategoriesController::class,'show']);

//sub_categories
Route::post('/sub_categories',[SubCategoriesController::class,'store']);
Route::get('/sub_categories',[SubCategoriesController::class,'index']);
Route::put('/sub_categories',[SubCategoriesController::class,'edit']);
Route::delete('/sub_categories/{subcategory}',[SubCategoriesController::class,'delete']);
Route::post('/sub_categories/edit/{subcategory}',[SubCategoriesController::class,'editSubcategory']);
Route::get('/sub_categories/{id}',[SubCategoriesController::class,'show']);
Route::get('/getFeatureTableName',[SubCategoriesController::class,'getFeatureTableName']);
Route::get('/getFeatureTableColumns',[SubCategoriesController::class,'getFeatureTableColumns']);
Route::get('/getBrandsAndVersions',[SubCategoriesController::class,'getBrandsAndVersions']);
Route::post('/storeSubCategoryFeatures',[SubCategoriesController::class,'storeSubCategoryFeatures']);


Route::get('/getExistingBrands',[SubCategoriesController::class,'getExistingBrands']);
Route::get('/get-feature-table/{subCategory}', [SubCategoriesController::class, 'getFeatureTable']);
Route::post('/addNewFeature', [SubCategoriesController::class, 'addFeature']);
Route::post('/newBrandAdding', [SubCategoriesController::class, 'newBrandAdding']);
Route::post('/getExistingFeature',[SubCategoriesController::class,'getExistingFeature']);
Route::post('/getExistingVersions',[SubCategoriesController::class,'getExistingVersions']);
Route::post('/addNewVersion',[SubCategoriesController::class,'addNewVersion']);



Route::post('/mobile_phone_features',[MobilePhoneFeaturesController::class,'store']);
Route::get('/mobile_phone_features',[MobilePhoneFeaturesController::class,'index']);
Route::put('/mobile_phone_features',[MobilePhoneFeaturesController::class,'edit']);
Route::delete('/mobile_phone_features',[MobilePhoneFeaturesController::class,'delete']);
Route::get('/mobile_phone_features/{id}',[MobilePhoneFeaturesController::class,'show']);
Route::get('/get-column-names', [MobilePhoneFeaturesController::class, 'getColNames']);
Route::get('/getMobileFeatures/{id}',[MobilePhoneFeaturesController::class, 'getMobileFeatures']);




// Route for creating a new brand name (POST)
Route::post('/mobile_phone_features/brand_names', [MobilePhoneFeaturesController::class, 'addBrandNames']);


Route::post('/mobile_phone_features/versions', [MobilePhoneFeaturesController::class, 'addVersions']);

Route::get('/mobile_phone_features/features/get', [MobilePhoneFeaturesController::class, 'getFeatures']);
Route::post('/mobile_phone_features/features', [MobilePhoneFeaturesController::class, 'addFeatures']);

// Route to fetch brands and their versions
Route::get('/mobile_phone/brands_and_versions', [MobilePhoneFeaturesController::class, 'getBrandsAndVersions']);

//Audio
Route::post('/Audio_features',[AudioFeaturesController::class,'store']);
Route::get('/Audio_features',[AudioFeaturesController::class,'index']);
Route::put('/Audio_features',[AudioFeaturesController::class,'edit']);
Route::delete('/Audio_features',[AudioFeaturesController::class,'delete']);
Route::get('/Audio_features/{id}',[AudioFeaturesController::class,'show']);
Route::get('/getAudioFeatures/{id}',[AudioFeaturesController::class, 'getAudioFeatures']);


Route::post('/Audio_features/brand_name',[AudioFeaturesController::class,'addBrandNames']);
Route::post('/Audio_features/version',[AudioFeaturesController::class,'addVersions']);
// Route to fetch brands and their versions
Route::get('/sound/brands_and_versions', [AudioFeaturesController::class, 'getBrandsAndVersions']);
Route::get('/get-sound-column-names', [AudioFeaturesController::class, 'getColNames']);

Route::post('/Healths_item_features',[HealthsItemFeaturesController::class,'store']);
Route::get('/Healths_item_features',[HealthsItemFeaturesController::class,'index']);
Route::put('/Healths_item_features',[HealthsItemFeaturesController::class,'edit']);
Route::delete('/Healths_item_features',[HealthsItemFeaturesController::class,'delete']);
Route::get('/Healths_item_features/{id}',[HealthsItemFeaturesController::class,'show']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
    Route::post('/reset', [AuthController::class, 'resetPassword']);
    Route::post('/verify-email', [AuthController::class, 'sendVerificationEmail']);
    Route::get('/verify-email', [AuthController::class, 'verifyEmail']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/validate_token', [AuthController::class, 'checkTokenValidity']);
        Route::delete('/delete', [AuthController::class, 'deleteUser']);
    });
});


Route::get('auth/google',[GoogleAuthController::class,'redirect']);
Route::get('auth/google/callback',[GoogleAuthController::class,'callbackGoogle']);

Route::get('facebook',[FacebookAuthController::class,'redirect']);
Route::get('auth/facebook/callback',[FacebookAuthController::class,'callBackFacebook']);

Route::middleware(['web'])->group(function () {
    Route::get('login/facebook', [SocialiteController::class, 'redirectToFacebook']);
    Route::get('login/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);

    Route::get('login/google', [SocialiteController::class, 'redirectToGoogle']);
    Route::get('login/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
});


Route::controller(AuthOtpController::class)->group(function(){
    Route::post('/otp/generate', 'generate');
    Route::post('/otp/verify','loginWithOtp');
});

Route::group(['prefix'=>'my','middleware'=>'auth'],function($router){
    Route::get('/ads',[userController::class,'getFreeAds']);
    Route::put('/profile/edit',[AuthController::class,'editUserDetails']);
    Route::get('/getBargainAds',[userController::class,'getMyBargainAds']);
    Route::get('/getBargainPrice',[userController::class,'getBargainPriceForMyAds']);
    Route::get('/getNotifications',[userController::class,'getNotifications']);
    Route::post('/submitSupportRequest',[userReportController::class,'submitSupportRequest']);
    Route::post('/addMobileNumber',[userController::class,'addMobileNumber']);
});
Route::post('/my/report-mark-as-read',[userController::class,'markAsRead']);


Route::group(['prefix' => 'town'], function () {
    Route::get('/get', [TownController::class, 'index']);
    Route::post('/add', [TownController::class, 'store']);
    Route::delete('/remove', [TownController::class, 'delete']);
    Route::get('/get/{id}', [TownController::class, 'show']);
    Route::post('/getSpecificTowns', [TownController::class, 'getSpecificTowns']);
});


Route::group(['prefix'=>'district'],function(){
    Route::get('/get',[DistrictController::class,'index']);
    Route::post('/add',[DistrictController::class,'store']);
    Route::delete('/remove',[DistrictController::class,'delete']);
    Route::get('/get/{id}',[DistrictController::class],'show');
});

//bargain_ads
// Route::group(['prefix'=>'bargain_ads'],function(){
//     Route::get('/get',[bargain_adsController::class,'index']);
//     Route::post('/add',[bargain_adsController::class,'store']);
//     Route::delete('/remove',[bargain_adsController::class,'delete']);
//     Route::get('/get/{id}',[bargain_adsController::class],'show');
// });

Route::post('/bargain_ads',[bargain_adsController::class,'store']);
Route::get('/bargain_ads',[bargain_adsController::class,'index']);
Route::put('/bargain_ads',[bargain_adsController::class,'edit']);
Route::delete('/bargain_ads',[bargain_adsController::class,'delete']);
Route::get('/bargain_ads/{id}',[bargain_adsController::class,'show']);

Route::group(['prefix'=>'admin'],function(){
    Route::get('/getCounts',[AdminDashboardController::class,'getCounts']);
    Route::get('/getLatestAccountCreationDates',[AdminDashboardController::class,'getLatestAccountCreationDates']);
    Route::get('/getUserDetails',[AdminDashboardController::class,'getUserDetails']);
    Route::get('/getAdminUsers',[AdminDashboardController::class,'getAdminUsers']);
    Route::post('/deleteAdminUser',[AdminDashboardController::class,'deleteAdminUser']);
    Route::post('/createAdminUser',[AdminDashboardController::class,'createAdminUser']);
    Route::get('/getLast7DaysAds',[AdminDashboardController::class,'getLast7DaysAds']);
    Route::get('/status-count', [AdminDashboardController::class, 'getAdsStatusCount']);
    Route::get('/ads/live', [AdminDashboardController::class, 'getLiveAds']);
    Route::get('/ads/blocked', [AdminDashboardController::class, 'getBlockedAds']);
    Route::get('/ads/pending', [AdminDashboardController::class, 'getPendingAds']);
    Route::get('/getSpecificAds/{id}',[AdminDashboardController::class,'getSpecificAds']);
    Route::post('/editFreeAds',[AdminDashboardController::class,'editFreeAds']);
    Route::get('/getAllAdsByStatus/{status}',[AdminDashboardController::class,'getAdsByStatus']);
    Route::get('/getUserByStatus/{status}',[AdminDashboardController::class,'getUserByStatus']);
    Route::get('/getUserById/{id}',[AdminDashboardController::class,'getUserById']);
    Route::post('editUserStatus/{id}',[AdminDashboardController::class,'editUserStatus']);
    Route::post('/editFreeAdsStatus',[AdminDashboardController::class,'editFreeAdsStatus']);
    Route::post('/assignMe',[AdminDashboardController::class,'assignMe']);
    Route::post('/feedback',[AdminDashboardController::class,'addReportFeedBack']);
    Route::post('report/superAdminRequest',[AdminDashboardController::class,'addAdminRequest']);
    Route::get('/getAdminTasks',[AdminDashboardController::class,'getAdminTasks']); 
    Route::get('/getSuperAdminTasks',[AdminDashboardController::class,'getSuperAdminTasks']);
    Route::get('/getPaidAds',[AdminDashboardController::class,'getPaidAdsDetails']);
    Route::get('/getSpecificPaidAds/{id}',[AdminDashboardController::class,'getSpecificPaidAds']);
    Route::post('/updateBannerAd',[AdminDashboardController::class,'updateBannerAd']);
    Route::post('/add-sub-category',[AdminDashboardController::class,'addSubCategory']);
    Route::get('/getTodaysPaidAds',[AdminDashboardController::class,'getTodaysPaidAds']);
    Route::get('/getNextPaidAds',[AdminDashboardController::class,'getNextPaidAds']);
});

// todo => s3 image upload subcategory icon
Route::post('/upload-subcategory-icon', [SubCategoriesController::class, 'addSubCategoryIcon']);

Route::post('/upload', [ImageUploadController::class, 'upload'])->name('upload.image');
Route::get('/images', [ImageUploadController::class, 'index'])->name('images.index');

Route::get('/bargain_ads/{id}',[free_adController::class,'show']);

Route::group(['middleware'=>'auth'],function(){
    Route::post('/bargain_ads',[bargain_adsController::class,'store']);
});

Route::group(['middleware'=>'auth'],function(){
    Route::post('/paid_adCreate',[paid_adController::class,'store']);
    Route::delete('/paid_adCreate/{id}', [paid_adController::class, 'delete']);

});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/FavouriteAds', [FavouriteAdsController::class, 'index']);
    Route::get('/FavouriteAds/{id}',[FavouriteAdsController::class,'show']);
});

Route::middleware('auth:api')->post('/FavouriteAds', [FavouriteAdsController::class, 'addFavourite']); // Ensure the method name matches
Route::get('/FavouriteAds',[FavouriteAdsController::class,'getFavouriteAds']);

Route::group(['middleware'=>'auth'],function(){
    Route::get('/Ratings', [RatingsController::class, 'index']);
    Route::post('/Ratings',[RatingsController::class,'adRatings']);
    Route::get('/Ratings/{adId}', [RatingsController::class, 'getUserRating']);
    Route::delete('/Ratings/{adId}', [RatingsController::class, 'destroy']);
    Route::get('/Ratings/show/{id}',[RatingsController::class,'show']);
    
});
Route::get('/getRatedUsers/{id}',[RatingsController::class,'getRatedUsers']);


Route::get('getSpecificPaidAd',[paid_adController::class,'getSpecificAds']);
 
Route::group(['middleware'=>'auth'],function(){
    Route::post('/FavouriteAdsLoad', [FavouriteAdsLoadController::class, 'store']);
});

//user reports
Route::post('/user_reports',[userReportController::class,'store']);
Route::get('/getReports',[userReportController::class,'getReports']);
Route::get('/report/index/{id}',[userReportController::class,'getAdsById']);
Route::get('/getUserReports',[userReportController::class,'getUserReports']);

Route::get('/check',[userController::class,'check']);

//nav bar ads
Route::post('/nav_bar_ads',[navBarAdController::class,'store']);
Route::get('/getNavBarAds',[navBarAdController::class,'getNavBarAds']);

