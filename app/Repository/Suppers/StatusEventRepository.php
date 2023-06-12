<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Enums\PaymentEnum;
use App\Models\Event;

class StatusEventRepository
{
    public function changeStatus($attributes): bool|int
    {
        $event = Event::query()
            ->where('id', '=', $attributes->input('key'))
            ->first();

        if ($event->where('payment', PaymentEnum::PAID)->first() !== null) {
            return $event->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
