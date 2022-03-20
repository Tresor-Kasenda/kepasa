<?php

use App\Http\Controllers\Admins\CityAdminController;
use App\Http\Controllers\Admins\EventCountryAdminController;
use App\Http\Controllers\Admins\EventOrganiserAdminController;
use App\Http\Controllers\Admins\EventsAdminController;
use App\Http\Controllers\Admins\HomeAdminController;
use App\Http\Controllers\Apps\BookingController;
use App\Http\Controllers\Apps\ContactUsController;
use App\Http\Controllers\Apps\EventController;
use App\Http\Controllers\Apps\EventFeeController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Apps\PromotionRequestController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\Organisers\BookingOrganiserController;
use App\Http\Controllers\Organisers\CheckoutOrganiserController;
use App\Http\Controllers\Organisers\EnableXTokenController;
use App\Http\Controllers\Organisers\EventOrganiserController;
use App\Http\Controllers\Organisers\HomeOrganiserController;
use App\Http\Controllers\Organisers\ImageOrganiserController;
use App\Http\Controllers\Organisers\PaypalController;
use App\Http\Controllers\Organisers\ProfileOrganiserController;
use App\Http\Controllers\Supers\AdminSupperController;
use App\Http\Controllers\Supers\BillingSupperController;
use App\Http\Controllers\Supers\CategorySupperController;
use App\Http\Controllers\Supers\CountrySupperController;
use App\Http\Controllers\Supers\EventCountrySupperController;
use App\Http\Controllers\Supers\EventSupperController;
use App\Http\Controllers\Supers\HomeSuperController;
use App\Http\Controllers\Supers\OrganiserSupperController;
use App\Http\Controllers\Supers\PromotedEventSuperController;
use App\Http\Controllers\Supers\SettingSupperController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'supper', 'as' => 'supper.', 'middleware' => ['supper', 'auth']], function(){
    Route::resource('dashboard', HomeSuperController::class);
    Route::resource('viewEvents', EventSupperController::class);
    Route::resource('eventsCountries', EventCountrySupperController::class);
    Route::resource('organisers', OrganiserSupperController::class);
    Route::resource('admins', AdminSupperController::class);
    Route::resource('category', CategorySupperController::class);
    Route::resource('countries', CountrySupperController::class);

    Route::controller(PromotedEventSuperController::class)->group(function(){
        Route::put('promotedEvent/{key}', 'promoted')->name('event.promoted');
        Route::put('RemovePromotion/{key}', 'notPromoted')->name('event.notPromoted');
        Route::put('changeStatus/{eventKey}/update', 'changeStatus')->name('status.update');
    });

    Route::controller(SettingSupperController::class)->group(function (){
        Route::get('settings', '__invoke')->name('settings.index');
        Route::put('settings/{adminUid}', 'storeApps')->name('settings.store');
        Route::put('updatePassword/{adminUid}', 'updatePassword')->name('settings.password');
    });

    Route::controller(BillingSupperController::class)->group(function (){
        Route::get('billings', '__invoke')->name('billing.index');
        Route::get('billings/{billingKey}', 'show')->name('billing.show');
        Route::get('invoice/{key}', 'invoice')->name('billing.invoice');
    });
});

Route::group(['prefix' => 'organiser', 'as' => 'organiser.', 'middleware' => ['organiser', 'auth']], function(){
    Route::resource('organiser', HomeOrganiserController::class);
    Route::resource('profile', ProfileOrganiserController::class);
    Route::resource('bookings', BookingOrganiserController::class);
    Route::resource('images', ImageOrganiserController::class);
    Route::resource('events', EventOrganiserController::class);
    Route::resource('events.payment', CheckoutOrganiserController::class);

    Route::controller(CheckoutOrganiserController::class)->group(function(){
        Route::post('confirm-payment', 'confirmed')->name('confirm.payment.event');
        Route::get('confirmation/{event}/update', 'updateCheckout')->name('checkout.confirmed');
    });

    Route::controller(ProfileOrganiserController::class)->group(function(){
        Route::post('imagesProfile',  'uploadPicture')->name('profile.images');
        Route::post('updateCompany', 'updateCompany')->name('company.update');
    });

    Route::controller(EnableXTokenController::class)->group(function(){
        Route::post('createToken', 'createToken')->name('enable.token');
        Route::get('getRoom/{token}/{roomId}', "joinRoom")->name('enable.joinRoom');
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
    Route::controller(BookingController::class)->group(function(){
        Route::post('confirm/{key}/bookings', 'confirmation')->name('booking.confirmation');
        Route::get('payment/{eventId}', 'confirmationPayment')->name('confirmation.payment');
    });
});

Route::controller(HomeController::class)->group(function (){
    Route::get('/', '__invoke')->name('home.index');
    Route::post('country', 'getCities')->name('cities.listens');
    Route::get('cityDetails/{cityName}', 'detailsCity')->name('city.detail');
});

Route::controller(PromotionRequestController::class)->group(function (){
    Route::get('promotion-request', '__invoke')->name('promotion.request');
    Route::post('promotion-request', 'store')->name('promotion.store');
});

Route::controller(EventController::class)->group(function (){
    Route::get('/evenements', '__invoke')->name('event.index');
    Route::get('/evenements/{event}','show')->name('event.show');
    Route::get('search-events', 'searchEvents')->name('search.events');
});
Route::get('evenements/{key}/bookings', [BookingController::class, 'bookings'])->name('booking.event');
Route::get('/event-fees', EventFeeController::class)->name('fee.index');
Route::get('/term-and-conditions', [EventFeeController::class, 'terms'])->name('term.details');
Route::get('/contact-us', ContactUsController::class)->name('contact.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');
