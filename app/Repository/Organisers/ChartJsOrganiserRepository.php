<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ChartJsOrganiserRepository
{
    public function getPaymentForEventOrganiserByDay(): array|Collection
    {
        return Customer::query()
            ->where('user_id', '=', auth()->id())
            ->select(
                DB::raw('COUNT(*) as count'),
                DB::raw('DAYNAME(created_at) as day_name'),
                DB::raw('DAY(created_at) as day')
            )
            ->where('created_at', '>', Carbon::today()->subDay(7))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();
    }
}
