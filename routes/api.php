<?php

use App\Http\Controllers\Api\PaypalPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'paypal'], function(){
    Route::controller(PaypalPaymentController::class)->group(function (){
        Route::post('/order/create', 'create')->name('paypal.transaction');
        Route::post('/order/capture', 'create')->name('paypal.capture.transaction');
    });
});
