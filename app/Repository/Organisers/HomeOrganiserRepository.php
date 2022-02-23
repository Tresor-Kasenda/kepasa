<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Event;
use App\Models\PaymentCustomer;
use Illuminate\Database\Eloquent\Collection;

class HomeOrganiserRepository
{
    public function getContents(): Collection|array
    {
        return PaymentCustomer::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }
}
