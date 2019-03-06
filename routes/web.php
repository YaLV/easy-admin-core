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

Route::get('/{lang}/sa', function () {
    return view('frontend.pages.farmers', ['suppliers' => \App\Plugins\Suppliers\Model\Supplier::all()->pluck('id')]);
})->name('farmers');
Route::get('/sa', function () {
    return view('frontend.pages.farmers', ['suppliers' => \App\Plugins\Suppliers\Model\Supplier::all()->pluck('id')]);
})->name('farmers.default');


Route::get('{lang}/sa/{farmer}', function ($farmer) {
    $farmer = (new \App\Plugins\Suppliers\Model\SupplierMeta)->where(['meta_name' => 'slug', 'meta_value' => $farmer])->firstOrFail()->supplier;

    return view('frontend.pages.farmer', ['supplier' => $farmer, 'supplierCache' => (new \App\Http\Controllers\CacheController)->getSupplier($farmer->id)]);
})->name('farmer');
Route::get('/sa/{farmer}', function ($farmer) {
    $farmer = (new \App\Plugins\Suppliers\Model\SupplierMeta)->where(['meta_name' => 'slug', 'meta_value' => $farmer])->firstOrFail()->supplier;

    return view('frontend.pages.farmer', ['supplier' => $farmer, 'supplierCache' => (new \App\Http\Controllers\CacheController)->getSupplier($farmer->id)]);
})->name('farmer.default');


// Images
Route::pattern("imPath", implode("|", config('app.uploadFile')));
Route::get('/{imPath}/{size}/{file}', "FrontController@showImage")->name('image')->where("size", "(\d{1,4}x\d{1,4}|x\d{1,4}|\d{1,4}x)");
Route::get('/{imPath}/{file}', "FrontController@showImage")->name('image.nosize');

// Profile Stuff
Route::get("/{lang}/profile", 'ProfileController@index')->name('profile');
Route::get("/profile", 'ProfileController@index')->name('profile.default');
Route::post("/{lang}/profile", 'ProfileController@store')->name('profile.save');
Route::post("/profile", 'ProfileController@store')->name('profile.save.default');

// Verify Changed Email
Route::get("/{lang}/verify/{action}/{verifyString}", 'ProfileController@verify')->name('verifyChangedEmail.save');
Route::get("/verify/{action}/{verifyString}", 'ProfileController@verify')->name('verifyChangedEmail.default');

// Home Page
Route::pattern('lang', implode("|", languages()->pluck("code")->toArray()));
Route::get('/{lang}', 'FrontController@page')->name('home');
Route::get('/', 'FrontController@page')->name('home.default');

// Cart
Route::get("/{lang}/cart", "\App\Plugins\Orders\CartController@index")->name('cart');
Route::get("/cart", "\App\Plugins\Orders\CartController@index")->name('cart.default');

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


