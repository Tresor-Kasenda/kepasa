<?php

use App\Http\Controllers\Admins\HomeAdminController;
use App\Http\Controllers\Apps\ContactUsController;
use App\Http\Controllers\Apps\EventController;
use App\Http\Controllers\Apps\EventFeeController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Apps\PromotionRequestController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\Organisers\HomeOrganiserController;
use App\Http\Controllers\Supers\AdminSupperController;
use App\Http\Controllers\Supers\BillingSupperController;
use App\Http\Controllers\Supers\CountrySupperController;
use App\Http\Controllers\Supers\EventCountrySupperController;
use App\Http\Controllers\Supers\EventSupperController;
use App\Http\Controllers\Supers\HomeSuperController;
use App\Http\Controllers\Supers\OrganiserSupperController;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::group(['prefix' => 'supper', 'as' => 'supper.', 'middleware' => ['supper', 'auth']], function(){
    Route::resource('dashboard', HomeSuperController::class);
    Route::get('viewEvents', EventSupperController::class)->name('events.listens');
    Route::get('eventsCountries', EventCountrySupperController::class)->name('events.country');
    Route::resource('organisers', OrganiserSupperController::class);
    Route::resource('admins', AdminSupperController::class);
    Route::get('countries', CountrySupperController::class)->name('countries.listens');
    Route::get('billings', BillingSupperController::class)->name('billing.index');
});

Route::group(['prefix' => 'organiser', 'as' => 'organiser.', 'middleware' => ['organiser', 'auth']], function(){
    Route::resource('organiser', HomeOrganiserController::class);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function(){
    Route::resource('admin', HomeAdminController::class);
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function(){
    Route::resource('home', HomeUserController::class);
});

Route::get('/', HomeController::class)->name('home.index');
Route::get('/promotion-request', PromotionRequestController::class)->name('promotion.request');
Route::get('/evenements', EventController::class)->name('event.index');
Route::get('/evenements/{event}', [EventController::class, 'show'])->name('event.show');
Route::get('/event-fees', EventFeeController::class)->name('fee.index');
Route::get('/term-and-conditions', [EventFeeController::class, 'terms'])->name('term.details');
Route::get('/contact-us', ContactUsController::class)->name('contact.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');
