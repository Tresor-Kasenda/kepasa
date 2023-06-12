<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Cities;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Repository\Suppers\Cities\CountryCitiesRepository;
use Illuminate\Contracts\View\View;

class ShowCityController extends Controller
{
    public function __invoke(Country $country, CountryCitiesRepository $repository): View
    {
        return view('admins.pages.countries.show', [
            'cities' => $repository->getCities($country),
        ]);
    }
}
