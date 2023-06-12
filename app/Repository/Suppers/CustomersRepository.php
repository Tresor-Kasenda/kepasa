<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CustomersRepository
{
    public function getInvoices(Request $request): array|Collection
    {
        return Customer::query()
            ->with(['event', 'user'])
            ->search(
                search: $request->input('search')
            )
            ->sortBy(
                sortBy: $request->input('sortBy'),
                direction: $request->input('direction', 'DESC')
            )
            ->get();
    }
}
