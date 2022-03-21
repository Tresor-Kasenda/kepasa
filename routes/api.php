<?php

use App\Http\Controllers\Organisers\PaypalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'paypal'], function(){
    Route::controller(PaypalController::class)->group(function (){
        Route::post('/order/create', 'create')->name('paypal.create.transaction');
        Route::post('/order/capture', 'capture')->name('paypal.capture.transaction');
    });
});
