<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Country\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\View;

class ShowCountryCityController extends Controller
{
    public function __invoke(City $city)
    {
        return View::make(
            view: 'admins.pages.countries.city_show',
            data: compact('city')
        );
    }
}
