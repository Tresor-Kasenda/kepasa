<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EventCountrySupperRepository
{
    public function getContents(): Collection
    {
        return DB::table('events')
            ->orderBy('created_at')
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();
    }

    public function getEventByCountry(string $country): Collection|array
    {
        $events = Event::query()
            ->where('country', '=', base64_decode($country))
            ->get();

        return $events->load(['onlineEvent', 'user']);
    }
}
