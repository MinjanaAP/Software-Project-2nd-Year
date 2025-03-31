<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    try{
        DB::connection()->getPdo();
        return 'Connected Successfully';
    }
    catch(\Exception $e){
        dd($e->getMessage());
        return 'Connection Failed';
    }
});

Route::get('/free_adCreate',function(){
    return view('free_adCreate');
});

Route::get('/redirect-message', function () {
    $status = request()->query('status');
    $message = request()->query('message');
    $frontendUrl = config('app.APP_STAGING_URL'); 
    return redirect()->away("$frontendUrl?status=$status&message=$message");
})->name('redirect-message');




Route::post('/free_adCreate', 'App\Http\Controllers\free_adController@create');

Route::get('/paid_adCreate',function(){
    return view('paid_adCreate');
});

Route::post('/paid_adCreate', 'App\Http\Controllers\paid_adController@create');

Route::get('/paid_ad_typeCreate',function(){
    return view('paid_ad_typeCreate');
});

Route::post('/paid_ad_typeCreate', 'App\Http\Controllers\paid_ad_typeController@create');

Route::get('/free_adCreate/{id}', 'App\Http\Controllers\free_adController@show');

Route::get('paid_adCreate/{id}', 'App\Http\Controllers\paid_adController@show');

Route::get('/user_roleCreate',function(){
    return view('user_roleCreate');
});

Route::post('/user_roleCreate', 'App\Http\Controllers\user_roleController@create');

Route::get('/userCreate',function(){
    return view('userCreate');
});

Route::post('/site_visitors', 'App\Http\Controllers\site_visitorsController@create');

Route::get('/site_visitors',function(){
    return view('site_visitors');
});


Route::post('/category_create', 'App\Http\Controllers\CategoriesController@create');

Route::get('/category_create',function(){
    return view('category_create');
});


// Route::post('/category_create', 'App\Http\Controllers\SubCategoriesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });

// Route::post('/category_create', 'App\Http\Controllers\SubCategoriesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });


Route::post('/category_create', 'App\Http\Controllers\AudioFeaturesController@create');

Route::get('/category_create',function(){
         return view('category_create');
 });


// Route::post('/category_create', 'App\Http\Controllers\ComputerFeaturesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });


// Route::post('/category_create', 'App\Http\Controllers\HealthsItemFeaturesController@create');

// Route::get('/category_create',function(){
//      return view('category_create');
//  });


// Route::post('/category_create', 'App\Http\Controllers\HomeAplicanceFeaturesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });


// Route::post('/category_create', 'App\Http\Controllers\HomeSecurityFeaturesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });


// Route::post('/category_create', 'App\Http\Controllers\MobilePhoneFeaturesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });


// Route::post('/category_create', 'App\Http\Controllers\TvFeaturesController@create');

// Route::get('/category_create',function(){
//     return view('category_create');
// });

Route::get('/reportCreate',function(){
    return view('reportCreate');
});

Route::post('/reportCreate', 'App\Http\Controllers\reportController@create');

Route::get('/bargain_ads',function(){
    return view('bargain_ads');
});

Route::post('/bargain_ads', 'App\Http\Controllers\bargain_adsController@create');
