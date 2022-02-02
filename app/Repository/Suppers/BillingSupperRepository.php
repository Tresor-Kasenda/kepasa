<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Billing;
use Illuminate\Support\Collection;

class BillingSupperRepository
{
    public function getContents(): array|Collection
    {
        return Billing::query()
            ->with('event')
            ->get();
    }
}
