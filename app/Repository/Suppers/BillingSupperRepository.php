<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BillingSupperRepository
{
    public function getContents(): array|Collection
    {
        return Billing::query()
            ->with('event')
            ->get();
    }

    public function getBillingByKey(string $key): Model|Builder|null
    {
        $billing = Billing::query()
            ->where('key', '=', $key)
            ->first();

        return $billing->load(['event', 'user']);
    }
}
