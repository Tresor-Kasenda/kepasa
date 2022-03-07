<?php
declare(strict_types=1);

namespace App\View\Composers;

use Illuminate\View\View;
use Stevebauman\Location\Facades\Location;
use Stevebauman\Location\Position;

class UserLocation
{
    public function __construct(){}

    public function compose(View $view)
    {
        $location = $this->getLocation();
        $view->with('location', $location);
    }

    private function getLocation(): bool|Position
    {
        if (config('app.env') === 'production') {
            $ip = request()->ip();
           return Location::get($ip);
        }
        return false;
    }

}
