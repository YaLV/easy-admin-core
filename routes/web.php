<?php

// --------------- ADMIN ROUTES ------------------- //
Route::group(['prefix' => 'admin'], function() {
    Auth::routes(['register' => false, 'reset' => false]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function(){
    \App\Plugins\Admin\AdminController::adminRoutes();
//    Route::get('/aaa', '\App\Plugins\MarketDays\MarketDaysController@listMarketDays');
});


// --------------- PUBLIC ROUTES ------------------- //

Route::pattern('lang', implode("|",languages()->pluck("code")->toArray()));
Route::get('/{lang?}', function () {
    return view('layouts.app');
});

// Category Listing
Route::get("{lang}/category/{category1}/{category2?}/{category3?}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('category');
Route::get("/category/{category1}/{category2?}/{category3?}", "\App\Plugins\Categories\CategoryFrontendController@defaultIndex")->name('category.default');

//Product Viewing
Route::get("{lang}/product/{category1}/{product}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('product-1');
Route::get("{lang}/product/{category1}/{category2}/{product}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('product-2');
Route::get("{lang}/product/{category1}/{category2}/{category3}/{product}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('product-3');

Route::get("/product/{category1}/{product}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('product-1.default');
Route::get("/product/{category1}/{category2}/{product}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('product-2.default');
Route::get("/product/{category1}/{category2}/{category3}/{product}", "\App\Plugins\Categories\CategoryFrontendController@index")->name('product-3.default');


Route::get("/{lang}/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url');
Route::get("/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url.default');