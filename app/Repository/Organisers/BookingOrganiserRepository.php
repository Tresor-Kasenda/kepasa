<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookingOrganiserRepository
{
    public function getContent(): LengthAwarePaginator
    {
        return Customer::query()
            ->where('user_id', '!=', auth()->id())
            ->with('event')
            ->orderByDesc('created_at')
            ->paginate(6);
    }
}
