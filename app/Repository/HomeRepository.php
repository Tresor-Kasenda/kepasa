<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Country;
use Illuminate\Support\Collection;

class HomeRepository
{
    public function getCountries(): array|Collection
    {
        return Country::query()
            ->get();
    }

    public function getCitiesInCountry($attributes): array|Collection
    {
        return Country::getCitiesInCountry($attributes->all());
    }
}
