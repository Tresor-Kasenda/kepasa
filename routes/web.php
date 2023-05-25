<?php

declare(strict_types=1);

use App\Http\Controllers\Admins\CityAdminController;
use App\Http\Controllers\Admins\EventCountryAdminController;
use App\Http\Controllers\Admins\EventOrganiserAdminController;
use App\Http\Controllers\Admins\EventsAdminController;
use App\Http\Controllers\Admins\HomeAdminController;
use App\Http\Controllers\Apps\Bookings\BookingController;
use App\Http\Controllers\Apps\Cities\CountriesController;
use App\Http\Controllers\Apps\Cities\ShowCityController;
use App\Http\Controllers\Apps\ContactUsController;
use App\Http\Controllers\Apps\EventFeeController;
use App\Http\Controllers\Apps\Events\ListEventsController;
use App\Http\Controllers\Apps\Events\SearchEventsController;
use App\Http\Controllers\Apps\Events\ShowEventsController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Apps\Promoted\PromotedController;
use App\Http\Controllers\Apps\Promoted\StorePromotedController;
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
use App\Http\Controllers\Supers\Events\DestroyEventAdminController;
use App\Http\Controllers\Supers\Events\ListsEventAdminController;
use App\Http\Controllers\Supers\Events\ShowEventAdminController;
use App\Http\Controllers\Supers\Events\UpdateEventAdminController;
use App\Http\Controllers\Supers\HomeSuperController;
use App\Http\Controllers\Supers\OrganiserSupperController;
use App\Http\Controllers\Supers\PromotedEventSuperController;
use App\Http\Controllers\Supers\SettingSupperController;
use App\Http\Controllers\Users\InvoiceCustomerController;
use App\Http\Controllers\Users\PaypalCustomerController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function (): void {
    Route::group(['prefix' => 'supper', 'as' => 'supper.', 'middleware' => ['supper']], function (): void {
        Route::get('/', HomeSuperController::class)->name('dashboard');

        Route::get('events', ListsEventAdminController::class)->name('events.index');
        Route::get('events/{key}', ShowEventAdminController::class)->name('events.show');
        Route::get('events/{key}', UpdateEventAdminController::class)->name('events.edit');
        Route::delete('events/destroy', DestroyEventAdminController::class)->name('events.destroy');

        Route::resource('eventsCountries', EventCountrySupperController::class);
        Route::resource('organisers', OrganiserSupperController::class);
        Route::resource('admins', AdminSupperController::class);
        Route::resource('category', CategorySupperController::class);
        Route::resource('countries', CountrySupperController::class);

        Route::controller(PromotedEventSuperController::class)->group(function (): void {
            Route::put('promotedEvent/{key}', 'promoted')->name('event.promoted');
            Route::put('RemovePromotion/{key}', 'notPromoted')->name('event.notPromoted');
            Route::put('changeStatus/{eventKey}/update', 'changeStatus')->name('status.update');
        });

        Route::controller(SettingSupperController::class)->group(function (): void {
            Route::get('settings', '__invoke')->name('settings.index');
            Route::put('settings/{adminUid}', 'storeApps')->name('settings.store');
            Route::put('updatePassword/{adminUid}', 'updatePassword')->name('settings.password');
        });

        Route::controller(BillingSupperController::class)->group(function (): void {
            Route::get('billings', '__invoke')->name('billing.index');
            Route::get('billings/{billingKey}', 'show')->name('billing.show');
            Route::get('invoice/{key}', 'invoice')->name('billing.invoice');
        });
    });

    Route::group(['prefix' => 'organiser', 'as' => 'organiser.', 'middleware' => ['organiser']], function (): void {
        Route::get('/', HomeOrganiserController::class)->name('index');
        Route::resource('profile', ProfileOrganiserController::class);
        Route::resource('bookings', BookingOrganiserController::class);
        Route::resource('images', ImageOrganiserController::class);
        Route::resource('events', EventOrganiserController::class);
        Route::resource('events.payment', CheckoutOrganiserController::class);

        Route::controller(CheckoutOrganiserController::class)->group(function (): void {
            Route::post('confirm-payment', 'confirmed')->name('confirm.payment.event');
            Route::get('confirmation/{event}/update', 'updateCheckout')->name('checkout.confirmed');
        });

        Route::controller(ProfileOrganiserController::class)->group(function (): void {
            Route::post('imagesProfile', 'uploadPicture')->name('profile.images');
            Route::post('updateCompany', 'updateCompany')->name('company.update');
        });

        Route::controller(EnableXTokenController::class)->group(function (): void {
            Route::post('createToken', 'createToken')->name('enable.token');
            Route::get('getRoom/{token}/{roomId}', 'joinRoom')->name('enable.joinRoom');
        });

        Route::controller(PaypalController::class)->group(function (): void {
            Route::post('/order/create', 'create')->name('paypal.create.transaction');
            Route::post('/order/capture', 'capture')->name('paypal.capture.transaction');
        });
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function (): void {
        Route::resource('admin', HomeAdminController::class);
        Route::resource('eventsCountries', EventCountryAdminController::class);
        Route::resource('eventsAdmins', EventsAdminController::class);
        Route::resource('eventsOrganisers', EventOrganiserAdminController::class);
        Route::resource('cityMedia', CityAdminController::class);
    });

    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user']], function (): void {
        Route::resource('home', HomeUserController::class);
        Route::controller(BookingController::class)->group(function (): void {
            Route::post('confirm/{key}/bookings', 'confirmation')->name('booking.confirmation');
            Route::get('payment/{eventId}', 'confirmationPayment')->name('confirmation.payment');
        });

        Route::controller(PaypalCustomerController::class)->group(function (): void {
            Route::post('/order/create', 'create')->name('paypal.create');
            Route::post('/order/capture', 'capture')->name('paypal.capture');
        });

        Route::get('invoice/{customerId}/download', InvoiceCustomerController::class)->name('invoice.download');

        Route::get('evenements/{key}/bookings', [BookingController::class, 'bookings'])->name('booking.event');
    });

});

Route::get('/', HomeController::class)->name('home.index');
Route::get('country', CountriesController::class)->name('country.index');
Route::get('country/{cityName}', ShowCityController::class);

Route::get('events', ListEventsController::class)->name('event.index');
Route::get('event/{event}', ShowEventsController::class)->name('event.show');
Route::get('search', SearchEventsController::class)->name('event.search');

Route::get('promoted', PromotedController::class)->name('promoted.index');
Route::post('promoted/store', StorePromotedController::class)->name('promoted.store');

Route::get('/event-fees', EventFeeController::class)->name('fee.index');
Route::get('/term-and-conditions', [EventFeeController::class, 'terms'])->name('term.details');
Route::get('/contact-us', ContactUsController::class)->name('contact.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');
