<?php

declare(strict_types=1);

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
use App\Http\Controllers\Organisers\EnableXTokenController;
use App\Http\Controllers\Organisers\Events\CreateEventController;
use App\Http\Controllers\Organisers\Events\DeleteEventController;
use App\Http\Controllers\Organisers\Events\EditEventController;
use App\Http\Controllers\Organisers\Events\Payments\ConfirmPaymentController;
use App\Http\Controllers\Organisers\Events\Payments\PaymentEventController;
use App\Http\Controllers\Organisers\Events\ShowEventController;
use App\Http\Controllers\Organisers\Events\StoreEventController;
use App\Http\Controllers\Organisers\Events\UpdateEventController;
use App\Http\Controllers\Organisers\HomeOrganiserController;
use App\Http\Controllers\Organisers\ImageOrganiserController;
use App\Http\Controllers\Organisers\Profile\Company\UpdateCompanyController;
use App\Http\Controllers\Organisers\Profile\DeleteUsersController;
use App\Http\Controllers\Organisers\Profile\ProfileOrganiserController;
use App\Http\Controllers\Organisers\Profile\UpdateProfileController;
use App\Http\Controllers\Organisers\Profile\UploadProfileController;
use App\Http\Controllers\Supers\Categories\CreateCategoryController;
use App\Http\Controllers\Supers\Categories\ListCategoryController;
use App\Http\Controllers\Supers\Categories\StoreCategoryController;
use App\Http\Controllers\Supers\Company\ListCompanyController;
use App\Http\Controllers\Supers\Company\ShowCompanyController;
use App\Http\Controllers\Supers\Country\City\EditCountryCityController;
use App\Http\Controllers\Supers\Country\City\ShowCountryCityController;
use App\Http\Controllers\Supers\Country\City\UpdateCountryCityController;
use App\Http\Controllers\Supers\Country\ListCountryController;
use App\Http\Controllers\Supers\Events\ListsEventAdminController;
use App\Http\Controllers\Supers\Events\Promoted\StatusEventController;
use App\Http\Controllers\Supers\Events\ShowEventAdminController;
use App\Http\Controllers\Supers\Invoices\DownloadInvoiceController;
use App\Http\Controllers\Supers\Invoices\ListInvoicesController;
use App\Http\Controllers\Supers\Invoices\ShowInvoiceController;
use App\Http\Controllers\Supers\Settings\SettingController;
use App\Http\Controllers\Supers\Settings\SettingUpdateController;
use App\Http\Controllers\Supers\Settings\SettingUpdatePasswordController;
use App\Http\Controllers\Supers\SuperHomeController;
use App\Http\Controllers\Supers\Users\CreateUsersController;
use App\Http\Controllers\Supers\Users\DeleteUserController;
use App\Http\Controllers\Supers\Users\EditUserController;
use App\Http\Controllers\Supers\Users\ListUsersController;
use App\Http\Controllers\Supers\Users\ShowUsersController;
use App\Http\Controllers\Supers\Users\StoreUsersController;
use App\Http\Controllers\Supers\Users\UpdateStatusUserController;
use App\Http\Controllers\Supers\Users\UpdateUserController;
use App\Http\Controllers\Users\InvoiceCustomerController;
use App\Http\Controllers\Users\PaypalCustomerController;
use App\Http\Middleware\EnsureDefaultPasswordIsChanged;
use App\Http\Middleware\EnsureOrganiserPasswordChange;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function (): void {

    Route::group(
        attributes: [
            'prefix' => 'supper',
            'as' => 'supper.',
            'middleware' => [
                'supper',
                EnsureDefaultPasswordIsChanged::class
            ]
        ],
        routes:  function (): void {
            Route::get('/index', SuperHomeController::class)->name('dashboard');

            Route::get('events', ListsEventAdminController::class)->name('events.index');
            Route::get('events/{event}/show', ShowEventAdminController::class)->name('events.show');
            Route::put('events/{event}/status', StatusEventController::class)->name('events.status');

            Route::get('users', ListUsersController::class)->name('users-list');
            Route::get('users/{user}/show', ShowUsersController::class)->name('users.show');
            Route::get('users/create', CreateUsersController::class)->name('users.create');
            Route::post('users', StoreUsersController::class)->name('users.store');
            Route::get('users/{user}/edit', EditUserController::class)->name('users.edit');
            Route::post('users/status', UpdateStatusUserController::class);
            Route::put('users/{user}/update', UpdateUserController::class)->name('users.update');
            Route::delete('users/{user}/delete', DeleteUserController::class)->name('users.delete');

            Route::get('category', ListCategoryController::class)->name('category-list');
            Route::get('category/create', CreateCategoryController::class)->name('category.create');
            Route::post('category', StoreCategoryController::class)->name('category.store');

            Route::get('country', ListCountryController::class)->name('country-list');
            Route::get('country/{country}/cities', ShowCityController::class)->name('country.city');
            Route::get('country/{city}/show', ShowCountryCityController::class)->name('country-city.show');
            Route::get('country/{city}/edit', EditCountryCityController::class)->name('cities.edit');
            Route::put('country/{city}/update', UpdateCountryCityController::class)->name('country-city.update');

            Route::get('invoices', ListInvoicesController::class)->name('invoices-list');
            Route::get('invoices/{billing}/show', ShowInvoiceController::class)->name('invoices.show');
            Route::get('invoices/{billing}/download', DownloadInvoiceController::class)->name('invoices.download');

            Route::get('setting', SettingController::class)->name('settings.index');
            Route::put('setting/{user}', SettingUpdateController::class)->name('settings.store');

            Route::put('password/{user}/update', SettingUpdatePasswordController::class)->name('settings.password');
            Route::put('admins/{user}/update', UpdateUserController::class)->name('admins.change');

            Route::get('company', ListCompanyController::class)->name('company-lists');
            Route::get('company/{company}/show', ShowCompanyController::class)->name('company.show');
        }
    );

    Route::group(
        attributes: [
            'prefix' => 'organiser',
            'as' => 'organiser.',
            'middleware' => [
                'organiser',
                EnsureOrganiserPasswordChange::class
            ]
        ],
        routes: function (): void {
            Route::get('/', HomeOrganiserController::class)->name('index');

            Route::get('profile', ProfileOrganiserController::class)->name('profile');
            Route::post('profile/{user}/update', UpdateProfileController::class)->name('profile.update');
            Route::post('profile/{user}/company', UpdateCompanyController::class)->name('profile.update.company');
            Route::post('profile/upload', UploadProfileController::class)->name('profile.upload');
            Route::delete('profile/{user}/delete', DeleteUsersController::class)->name('profile.delete');

            Route::get('event', \App\Http\Controllers\Organisers\Events\ListEventsController::class)->name('events-list');
            Route::get('event/{event}/show', ShowEventController::class)->name('events.show');
            Route::get('event/create', CreateEventController::class)->name('event.create');
            Route::post('event/store', StoreEventController::class)->name('event.store');
            Route::get('event/{event}/edit', EditEventController::class)->name('events.edit');
            Route::put('event/{event}/update', UpdateEventController::class)->name('events.update');
            Route::delete('event/{event}/delete', DeleteEventController::class)->name('events.delete');

            Route::get('event/{event}/payment', PaymentEventController::class)->name('events.payment');
            Route::post('event/{event}/confirm', ConfirmPaymentController::class)->name('event.confirm');

            Route::get('bookings', BookingOrganiserController::class)->name('bookings.index');
            Route::resource('images', ImageOrganiserController::class);

            Route::controller(EnableXTokenController::class)->group(function (): void {
                Route::post('createToken', 'createToken')->name('enable.token');
                Route::get('getRoom/{token}/{roomId}', 'joinRoom')->name('enable.joinRoom');
            });
        }
    );

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
