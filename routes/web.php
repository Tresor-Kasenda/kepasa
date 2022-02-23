<?php

use App\Http\Controllers\Admins\CityAdminController;
use App\Http\Controllers\Admins\EventCountryAdminController;
use App\Http\Controllers\Admins\EventOrganiserAdminController;
use App\Http\Controllers\Admins\EventsAdminController;
use App\Http\Controllers\Admins\HomeAdminController;
use App\Http\Controllers\Apps\ContactUsController;
use App\Http\Controllers\Apps\EventController;
use App\Http\Controllers\Apps\EventFeeController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Apps\PromotionRequestController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\Organisers\BookingOrganiserController;
use App\Http\Controllers\Organisers\CheckoutOrganiserController;
use App\Http\Controllers\Organisers\EventOrganiserController;
use App\Http\Controllers\Organisers\HomeOrganiserController;
use App\Http\Controllers\Organisers\ImageOrganiserController;
use App\Http\Controllers\Organisers\ProfileOrganiserController;
use App\Http\Controllers\Supers\AdminSupperController;
use App\Http\Controllers\Supers\BillingSupperController;
use App\Http\Controllers\Supers\CategorySupperController;
use App\Http\Controllers\Supers\CountrySupperController;
use App\Http\Controllers\Supers\EventCountrySupperController;
use App\Http\Controllers\Supers\EventSupperController;
use App\Http\Controllers\Supers\HomeSuperController;
use App\Http\Controllers\Supers\OrganiserSupperController;
use App\Http\Controllers\Supers\SettingSupperController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'supper', 'as' => 'supper.', 'middleware' => ['supper', 'auth']], function(){
    Route::resource('dashboard', HomeSuperController::class);
    Route::resource('viewEvents', EventSupperController::class);
    Route::get('eventsCountries', EventCountrySupperController::class)->name('events.country');
    Route::resource('organisers', OrganiserSupperController::class);
    Route::resource('admins', AdminSupperController::class);
    Route::get('countries', CountrySupperController::class)->name('countries.listens');
    Route::get('country/{countryCode}', [CountrySupperController::class, 'show'])->name('country.detail');
    Route::get('country/{countryCode}/edit', [CountrySupperController::class, 'edit'])->name('country.city.edit');
    Route::get('billings', BillingSupperController::class)->name('billing.index');
    Route::resource('category', CategorySupperController::class);
    Route::controller(SettingSupperController::class)->group(function (){
        Route::get('settings', '__invoke')->name('settings.index');
    });
});

Route::group(['prefix' => 'organiser', 'as' => 'organiser.', 'middleware' => ['organiser', 'auth']], function(){
    Route::resource('organiser', HomeOrganiserController::class);
    Route::resource('profile', ProfileOrganiserController::class);
    Route::resource('bookings', BookingOrganiserController::class);
    Route::resource('images', ImageOrganiserController::class);
    Route::resource('events', EventOrganiserController::class);
    Route::resource('events.payment', CheckoutOrganiserController::class);
    Route::post('confirm-payment', [CheckoutOrganiserController::class, 'confirmed'])->name('confirm.payment.event');

    Route::controller(ProfileOrganiserController::class)->group(function(){
        Route::post('imagesProfile',  'uploadPicture')->name('profile.images');
        Route::post('updateCompany', 'updateCompany')->name('company.update');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function(){
    Route::resource('admin', HomeAdminController::class);
    Route::resource('eventsCountries', EventCountryAdminController::class);
    Route::resource('eventsAdmins', EventsAdminController::class);
    Route::resource('eventsOrganisers', EventOrganiserAdminController::class);
    Route::resource('cityMedia', CityAdminController::class);
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function(){
    Route::resource('home', HomeUserController::class);
});

Route::get('/', HomeController::class)->name('home.index');
Route::get('/promotion-request', PromotionRequestController::class)->name('promotion.request');
Route::controller(EventController::class)->group(function (){
    Route::get('/evenements', '__invoke')->name('event.index');
    Route::get('/evenements/{event}','show')->name('event.show');
});
Route::get('/event-fees', EventFeeController::class)->name('fee.index');
Route::get('/term-and-conditions', [EventFeeController::class, 'terms'])->name('term.details');
Route::get('/contact-us', ContactUsController::class)->name('contact.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');

Route::post('country', [HomeController::class, 'getCities'])->name('cities.listens');
