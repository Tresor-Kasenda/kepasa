<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InvoicesEventsRepository
{
    public function getInvoices(Request $request): array|Collection
    {
        return Billing::query()
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
