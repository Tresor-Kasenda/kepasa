<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\CityEnum;
use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Services\LocationService\GetLocation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class HomeRepository
{
    public function getCountries(): array|Collection
    {
        return Country::query()
            ->orderBy('countryName', 'asc')
            ->get();
    }

    public function getContents(): LengthAwarePaginator
    {
        $location = GetLocation::location();
        if (null === $location) {
            return $this->getEvents()
                ->paginate(6);
        }

        return $this->getEvents()
            ->whereHas('city',  fn ($query) => $query->where('city_name', $location->cityName))
            ->paginate(6);
    }

    public function getCities(): Collection|array
    {
        return City::query()
            ->where('promoted', '=', CityEnum::APPROVAL_PROMOTION)
            ->get();
    }

    public function getCity(string $city): array
    {
        $city = City::query()
            ->where('promoted', '=', CityEnum::APPROVAL_PROMOTION)
            ->first();
        $event = $this->getEvents()
            ->where('city', '=', $city->cityName)
            ->get();

        return [$city, $event];
    }

    private function getEvents(): Builder
    {
        return Event::query()
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::STATUS_ACTIVE)
            ->where('promoted', '=', true);
    }
}
