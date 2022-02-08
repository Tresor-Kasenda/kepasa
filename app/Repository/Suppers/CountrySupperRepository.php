<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CountrySupperRepository
{
    public function getContents(): array|Collection
    {
        return Country::query()
            ->get();
    }

    public function getCitiesInCountry($attributes): Collection|array
    {
        return Country::getCitiesInCountry($attributes);
    }

    public function getSingleCity(string $key): Model|Builder|null
    {
        return City::query()
            ->where('cityName', '=', $key)
            ->first();
    }
}
