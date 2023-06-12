<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\CountryComposer;
use App\View\Composers\EventComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        View::composer([
            'organisers.pages.profiles.*',
            'organisers.pages.events.*',
            'apps.welcome',
            'admins.pages.*',
        ], CountryComposer::class);

        View::composer([
            'apps.welcome',
            'apps.pages.events.show',
        ], EventComposer::class);
    }
}
