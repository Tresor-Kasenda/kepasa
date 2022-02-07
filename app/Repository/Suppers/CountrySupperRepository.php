<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Country;
use Illuminate\Support\Collection;

class CountrySupperRepository
{
    public function getContents(): array|Collection
    {
        return Country::query()
            ->get();
    }

    public function getCitiesInCountry($attributes): \Illuminate\Database\Eloquent\Collection|array
    {
        return Country::getCitiesInCountry($attributes);
    }
}
