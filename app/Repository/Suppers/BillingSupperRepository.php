<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Collection;

class BillingSupperRepository
{
    public function getContents(): Collection|array
    {
        return Billing::query()
            ->orderByDesc('created_at')
            ->with('event')
            ->get();
    }
}
