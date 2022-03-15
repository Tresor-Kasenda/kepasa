<?php
declare(strict_types=1);

namespace App\Repository;

use App\Enums\CityPromotedEnum;
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
            ->get();
    }

    public function getCitiesInCountry($attributes): array|Collection
    {
        return Country::getCitiesInCountry($attributes->all());
    }

    public function getContents(): LengthAwarePaginator
    {
        $location = GetLocation::location();
        if ($location == null){
            return $this->getEvents()
                ->paginate(6);
        }
        return $this->getEvents()
            ->when('city', fn($query) => $query->where('city', $location->cityName ))
            ->paginate(6);
    }

    public function getCities(): Collection|array
    {
        return City::query()
            ->where('promoted', '=', CityPromotedEnum::PROMOTION)
            ->get();
    }

    public function getCity(string $city): array
    {
        $city = City::query()
            ->where('promoted', '=', CityPromotedEnum::PROMOTION)
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
            ->where('status', '=', StatusEnum::ACTIVE)
            ->where('promoted', '=', true);
    }
}
