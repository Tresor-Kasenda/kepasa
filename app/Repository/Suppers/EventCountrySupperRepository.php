<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Country;
use Illuminate\Support\Collection;

class EventCountrySupperRepository
{
    public function getContents(): array|Collection
    {
        return Country::query()
            ->orderByDesc('created_at')
            ->get();
    }
}
