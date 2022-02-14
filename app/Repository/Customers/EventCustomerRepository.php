<?php
declare(strict_types=1);

namespace App\Repository\Customers;

use Illuminate\Support\Facades\DB;

class EventCustomerRepository
{
    public function getUserPosition()
    {
        $lat = '';
        $lon = '';

        $data = DB::table("events")
            ->select("events.id"
                ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
                * cos(radians(events.latitude))
                * cos(radians(events.longitude) - radians(" . $lon . "))
                + sin(radians(" .$lat. "))
                * sin(radians(events.latitude))) AS distance"))
            ->groupBy("events.id")
            ->get();
    }
}
