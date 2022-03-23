<?php
declare(strict_types=1);

namespace App\Repository\Customers;

use App\Models\PaymentCustomer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventCustomerRepository
{
    public function getContent(): LengthAwarePaginator
    {
        return PaymentCustomer::query()
            ->with('event')
            ->where('user_id', '=', auth()->id())
            ->paginate(6);
    }

    public function getInvoiceContent(string $key): Model|Builder|null
    {
        $invoice = PaymentCustomer::query()
            ->where('key', '=', $key)
            ->where('user_id', '=', auth()->id())
            ->first();
        return $invoice->load('event');
    }

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
