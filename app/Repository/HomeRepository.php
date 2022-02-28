<?php
declare(strict_types=1);

namespace App\Repository;

use App\Enums\CityPromotedEnum;
use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use Illuminate\Support\Collection;

class HomeRepository
{
    public function getCountries(): array|Collection
    {
        return Country::query()
            ->get();
    }

    public function getCitiesInCountry($attributes): array|Collection
    {
        return Country::getCitiesInCountry($attributes->all());
    }

    public function getContents(): Collection|array
    {
        return Event::query()
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::ACTIVE)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getCities(): Collection|array
    {
        return City::query()
            ->where('promoted', '=', CityPromotedEnum::PROMOTION)
            ->latest()
            ->get();
    }

    public function getCity(string $city): array
    {
        $city = City::query()
            ->where('promoted', '=', CityPromotedEnum::PROMOTION)
            ->first();
        $event = Event::query()
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::ACTIVE)
            ->where('city', '=', $city->cityName)
            ->first();
        return [$city, $event];
    }

}
