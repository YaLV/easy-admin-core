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

// Cart Stuff
Route::get("/{lang}/cart", "\App\Plugins\Cart\CartController@index")->name('cart');
Route::get("/cart", "\App\Plugins\Cart\CartController@index")->name('cart.default');

Route::post("/{lang}/cart/add", "\App\Plugins\Orders\CartController@addToCart")->name('cartAdd');
Route::post("/cart/add", "\App\Plugins\Orders\CartController@addToCart")->name('cartAdd.default');



// Change MarketDay
Route::get("/setMarketDay/{timestamp}", "CacheController@selectMarketDay")->name('setMarketDay');



// Shop Stuff
Route::get("/{lang}/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url');
Route::get("/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url.default');