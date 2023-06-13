<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Billing;
use App\Models\Company;
use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChartJsSuperRepository
{
    public function getCompanyByMonths(): Collection
    {
        return Company::select(
            [DB::raw('COUNT(*) as count'),
                DB::raw('MONTHNAME(created_at) as month_name'),
            ]
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('month_name'))
            ->orderBy('id', 'ASC')
            ->pluck('count', 'month_name');
    }

    public function getEventsByMonths(): Collection
    {
        return Event::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTHNAME(created_at) as month_name')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('month_name'))
            ->orderBy('id', 'ASC')
            ->pluck('count', 'month_name');
    }
}
