<?php

use App\Http\Controllers\Apps\ContactUsController;
use App\Http\Controllers\Apps\EventController;
use App\Http\Controllers\Apps\EventFeeController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Apps\PromotionRequestController;
use App\Http\Controllers\Supers\HomeSuperController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home.index');
Route::get('/promotion-request', PromotionRequestController::class)->name('promotion.request');
Route::get('/evenements', EventController::class)->name('event.index');
Route::get('/evenements/{event}', [EventController::class, 'show'])->name('event.show');
Route::get('/event-fees', EventFeeController::class)->name('fee.index');
Route::get('/term-and-conditions', [EventFeeController::class, 'terms'])->name('term.details');
Route::get('/contact-us', ContactUsController::class)->name('contact.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'super', 'as' => 'super.', 'middleware' => ['super', 'auth']], function(){
    Route::resource('dashboard', HomeSuperController::class);
});
