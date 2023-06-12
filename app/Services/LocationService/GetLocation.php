<?php

declare(strict_types=1);

namespace App\Services\LocationService;

use Location;

class GetLocation
{
    public static function location()
    {
        if ('production' === config('app.env')) {
            $ip = request()->ip();

            return Location::get($ip);
        }
    }
}
