<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Country\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\View;

class EditCountryCityController extends Controller
{
    public function __invoke(City $city)
    {
        return View::make('admins.pages.countries.edit', compact('city'));
    }
}
