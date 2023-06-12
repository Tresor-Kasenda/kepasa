<?php

declare(strict_types=1);

namespace App\Services\LocationService;

use Location;

class GetLocation
{
    public static function location()
    {
        if (config('app.env') === 'production') {
            $ip = request()->ip();

            return Location::get($ip);
        }
    }
}
