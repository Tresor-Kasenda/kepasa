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
        return $this->getCity($key);
    }

    public function getCountry(string $countryCode): Model|Builder|null
    {
        return Country::query()
            ->where('countryCode', '=', $countryCode)
            ->first();
    }

    public function updateCity(string $cityName, $attributes): Model|Builder|null
    {
        $city = $this->getCity(key: $cityName);
        $city->update([
            "cityName" => $attributes->input('cityName'),
            "facts" => $attributes->input('facts'),
            "overview" => $attributes->input('overview'),
            "currency" => $attributes->input('currency'),
            "languages" => $attributes->input('languages'),
            "population" => $attributes->input('population'),
            "popularCity" => $attributes->input('popularCity'),
            "mayor" => $attributes->input('mayor'),
            "promoted" => $attributes->input('promoted'),
            "history" => $attributes->input('history')
        ]);
        toast("City is update", 'success');
        return $city;
    }

    private function getCity(string $key): null|Builder|Model
    {
        return City::query()
            ->where('cityName', '=', $key)
            ->first();
    }
}
