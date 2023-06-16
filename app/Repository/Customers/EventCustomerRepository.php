<?php

declare(strict_types=1);

namespace App\Repository\Customers;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EventCustomerRepository
{
    public function getContent(): LengthAwarePaginator
    {
        return Customer::query()
            ->with('event')
            ->where('user_id', '=', auth()->id())
            ->paginate(6);
    }

    public function getUserPosition($latitude, $longitude): Collection
    {
        return DB::table('events')
            ->select('events.id', DB::raw('6371 * acos(cos(radians('.$latitude.'))
                * cos(radians(events.latitude))
                * cos(radians(events.longitude) - radians('.$longitude.'))
                + sin(radians('.$latitude.'))
                * sin(radians(events.latitude))) AS distance'))
            ->groupBy('events.id')
            ->get();
    }
}
