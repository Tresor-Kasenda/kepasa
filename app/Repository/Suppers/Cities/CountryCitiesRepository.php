<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Cities;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryCitiesRepository
{
    public function getCities(Country $country): Collection|array
    {
        return City::query()
            ->where('countryCode', '=', $country->countryCode)
            ->get();
    }
}
