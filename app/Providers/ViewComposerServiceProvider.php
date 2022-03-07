<?php
declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\CountryComposer;
use App\View\Composers\EventComposer;
use App\View\Composers\UserLocation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @return void
     */
    public function boot()
    {
        View::composer([
            'organisers.pages.profiles.*',
            'organisers.pages.events.*',
            'apps.welcome',
            'admins.pages.countries',
            'admins.pages.eventCountries.index',
            'admins.pages.events.edit',
            'admins.pages.countries.*'
        ], CountryComposer::class);

        View::composer([
            'apps.welcome',
            'apps.pages.events.*'
        ], EventComposer::class);

        View::composer(['apps.*'], UserLocation::class);
    }
}
