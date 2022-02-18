<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\PaymentCustomer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BookingOrganiserRepository
{
    public function getContent(): LengthAwarePaginator
    {
        return PaymentCustomer::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->paginate(6);
    }
}
