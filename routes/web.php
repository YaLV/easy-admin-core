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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/a', '\App\Plugins\MarketDays\MarketDaysController@closestDay');

Route::post('/calcPrice', function() {
    $discounts = [
        \App\Plugins\Vat\Model\Unit::find(request('vat_id'))->amount??0,
        request('mark_up')?:0
    ];

   return ['status' => true, 'noMessage' => true, 'result' => calcPrice(request('price'), $discounts)];
});