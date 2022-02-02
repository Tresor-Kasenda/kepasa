<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountrySupperRepository
{
    public function getContents(): Collection|array
    {
        return Country::query()
            ->with('cities.countryCode')
            ->orderByDesc('created_at')
            ->get();
    }
}
