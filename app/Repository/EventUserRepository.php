<?php
declare(strict_types=1);

namespace App\Repository;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\Country;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EventUserRepository
{
    public function searchEvent($attributes): Collection|array
    {
        $country = Country::query()
            ->where('countryCode', '=', $attributes->input('country'))
            ->first();
        return Event::query()
            ->where('city', '=', $attributes->input('city'))
            ->where('country', '=', $country->countryName)
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::ACTIVE)
            ->get();
    }

    public function getEventByKey(string $key): Model|Builder|null
    {
        return Event::query()
            ->where('key', '=', $key)
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::ACTIVE)
            ->first();
    }
}
