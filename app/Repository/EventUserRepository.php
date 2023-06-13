<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\Country;
use App\Models\Event;
use App\Traits\GetSingleEvent;
use Illuminate\Database\Eloquent\Collection;

class EventUserRepository
{
    use GetSingleEvent;

    public function getContents(): Collection|array
    {
        return Event::query()
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::STATUS_ACTIVE)
            ->orderByDesc('created_at')
            ->get();
    }

    public function searchEvent($attributes): Collection|array
    {
        $country = Country::query()
            ->where('countryCode', '=', $attributes->input('country'))
            ->first();

        return Event::query()
            ->where('city', '=', $attributes->input('city'))
            ->where('country', '=', $country->countryName)
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::STATUS_ACTIVE)
            ->get();
    }
}
