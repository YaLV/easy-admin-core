<?php

// --------------- ADMIN ROUTES ------------------- //
Route::group(['prefix' => 'admin'], function() {
    Auth::routes(['register' => false, 'reset' => false]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function(){
    \App\Plugins\Admin\AdminController::adminRoutes();
});


// --------------- PUBLIC ROUTES ------------------- //

Route::pattern('lang', implode("|",languages()->pluck("code")->toArray()));
Route::get('/{lang?}', function () {
    return view('layouts.app');
});

// Cart
Route::get("/{lang}/cart", "\App\Plugins\Orders\CartController@index")->name('cart');
Route::get("/cart", "\App\Plugins\Orders\CartController@index")->name('cart.default');

// Add to cart/Change item in cart
Route::post("/{lang}/cart/save", "\App\Plugins\Orders\CartController@changeCartItem")->name('cartAdd');
Route::post("/cart/save", "\App\Plugins\Orders\CartController@changeCartItem")->name('cartAdd.default');

// Checkout
Route::get("/{lang}/checkout/{edit?}", "\App\Plugins\Orders\CartController@checkout")->name('checkout');
Route::get("/checkout/{edit?}", "\App\Plugins\Orders\CartController@checkout")->name('checkout.default');

Route::post("/{lang}/checkout", "\App\Plugins\Orders\CartController@saveUserInfo")->name('checkout.post');
Route::post("/checkout", "\App\Plugins\Orders\CartController@saveUserInfo")->name('checkout.post.default');

Route::get("/{lang}/payment", "\App\Plugins\Orders\CartController@payment")->name('payment');
Route::get("/payment", "\App\Plugins\Orders\CartController@payment")->name('payment.default');

Route::post("/{lang}/payment", "\App\Plugins\Orders\CartController@saveOrder")->name('payment.post');
Route::post("/payment", "\App\Plugins\Orders\CartController@saveOrder")->name('payment.post.default');

Route::get("/{lang}/thankyou", "\App\Plugins\Orders\CartController@thankyou")->name('thankyou');
Route::get("/thankyou", "\App\Plugins\Orders\CartController@thankyou")->name('thankyou.default');


// Change MarketDay
Route::get("/setMarketDay/{timestamp}", "CacheController@selectMarketDay")->name('setMarketDay');



// Shop Stuff
Route::get("/{lang}/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url');
Route::get("/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url.default');