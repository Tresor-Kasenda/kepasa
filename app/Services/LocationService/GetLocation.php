<?php

declare(strict_types=1);

namespace App\Services\LocationService;

use Location;
use Stevebauman\Location\Position;

class GetLocation
{
    public static function location(): Position|bool|string|null
    {
        if ('production' === config('app.env')) {
            $ip = request()->ip();

            return Location::get($ip);
        }
        return request()->ip();
    }
}
