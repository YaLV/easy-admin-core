<?php

// DEBUG

Route::any('/debug', function () {
    dd(Auth::user());
});


// --------------- ADMIN ROUTES ------------------- //
Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false, 'reset' => false]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    \App\Plugins\Admin\AdminController::adminRoutes();
});


// --------------- PUBLIC ROUTES ------------------- //

Route::pattern('lang', implode("|", languages()->pluck("code")->toArray()));
Route::pattern('pageSlug', implode('|', __('pages.slug')));

Route::get('/{lang}/{pageSlug?}', 'PageController@show')->name('page');
Route::get('/{pageSlug?}', 'PageController@show')->name('page.default');


// farmer Page
Route::pattern('supplierSlug', implode('|', __('supplier.slug')));
Route::pattern('suppliersSlug', getSupplierSlugs());
Route::get('/{lang}/{suppliersSlug}/{supplierSlug}', 'PageController@show')->name('supplierOpen');
Route::get('/{suppliersSlug}/{supplierSlug}', 'PageController@show')->name('supplierOpen.default');

// Images
Route::pattern("imPath", implode("|", array_merge(config('app.uploadFile'),['temp'])));
Route::get('/{imPath}/{size}/{file}', "FrontController@showImage")->name('image')->where("size", "(\d{1,4}x\d{1,4}|x\d{1,4}|\d{1,4}x|original)");
Route::get('/{imPath}/{file}', "FrontController@showImage")->name('image.nosize');

// Profile Stuff
Route::get("/{lang}/profile", 'ProfileController@index')->name('profile');
Route::get("/profile", 'ProfileController@index')->name('profile.default');
Route::post("/{lang}/profile", 'ProfileController@store')->name('profile.save');
Route::post("/profile", 'ProfileController@store')->name('profile.save.default');

// Verify Changed Email
Route::get("/{lang}/verify/{action}/{verifyString}", 'ProfileController@verify')->name('verifyChangedEmail.save');
Route::get("/verify/{action}/{verifyString}", 'ProfileController@verify')->name('verifyChangedEmail.default');
/*
// Home Page
Route::get('/{lang?}', 'FrontController@homepage')->name('home');
Route::get('/', 'FrontController@homepage')->name('home.default');*/

// Cart
Route::get("/{lang}/cart", "\App\Plugins\Orders\CartController@index")->name('cart');
Route::get("/cart", "\App\Plugins\Orders\CartController@index")->name('cart.default');

Route::get('/{lang}/cart/delivery/{delivery}', '\App\Plugins\Orders\CartController@setDelivery')->name('setDelivery');
Route::get('/cart/delivery/{delivery}', '\App\Plugins\Orders\CartController@setDelivery')->name('setDelivery.default');

// Add to cart/Change item in cart
Route::post("/{lang}/cart/save", "\App\Plugins\Orders\CartController@changeCartItem")->name('cartAdd');
Route::post("/cart/save", "\App\Plugins\Orders\CartController@changeCartItem")->name('cartAdd.default');

// Checkout Step 2
Route::get("/{lang}/checkout/{edit?}", "\App\Plugins\Orders\CartController@checkout")->name('checkout');
Route::get("/checkout/{edit?}", "\App\Plugins\Orders\CartController@checkout")->name('checkout.default');

Route::post("/{lang}/checkout", "\App\Plugins\Orders\CartController@saveUserInfo")->name('checkout.post');
Route::post("/checkout", "\App\Plugins\Orders\CartController@saveUserInfo")->name('checkout.post.default');

// Checkout Step 3
Route::get("/{lang}/payment", "\App\Plugins\Orders\CartController@payment")->name('payment');
Route::get("/payment", "\App\Plugins\Orders\CartController@payment")->name('payment.default');

Route::post("/{lang}/payment", "\App\Plugins\Orders\CartController@saveOrder")->name('payment.post');
Route::post("/payment", "\App\Plugins\Orders\CartController@saveOrder")->name('payment.post.default');

// Checkout Thankyou
Route::get("/{lang}/thankyou", "\App\Plugins\Orders\CartController@thankyou")->name('thankyou');
Route::get("/thankyou", "\App\Plugins\Orders\CartController@thankyou")->name('thankyou.default');


// Change MarketDay
Route::get("{lang}/setMarketDay/{timestamp}", "CacheController@selectMarketDay")->name('setMarketDay');
Route::get("/setMarketDay/{timestamp}", "CacheController@selectMarketDay")->name('setMarketDay.default');

//Login/register
Route::post('/{lang}/login', 'Auth\LoginController@login')->name('frontlogin');
Route::post('/login', 'Auth\LoginController@login')->name('frontlogin.default');

Route::get('{lang}/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register.default');

Route::post('{lang}/register', 'Auth\RegisterController@register')->name('register.post');
Route::post('/register', 'Auth\RegisterController@register')->name('register.post.default');

Route::any('/{lang}/logout', "Auth\LoginController@logout")->name('frontlogout');
Route::any('/logout', "Auth\LoginController@logout")->name('frontlogout.default');


// Shop Stuff
Route::get("/{lang}/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url');
Route::get("/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}", 'FrontController@divert')->name('url.default');


