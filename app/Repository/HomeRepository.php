<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Services\LocationService\GetLocation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use LaravelIdea\Helper\App\Models\_IH_City_C;

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

        return Event::query()
            ->when('status', fn($query) => $query->where('status', StatusEnum::STATUS_ACTIVE))
            ->when('payment', fn($query) => $query->where('payment', PaymentEnum::PAID))
            ->paginate(6);
    }

    private function getEvents(): Builder
    {
        return Event::query()
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::STATUS_ACTIVE)
            ->where('promoted', '=', true);
    }

    public function getCitiesInCountry(Request $request): \Illuminate\Database\Eloquent\Collection|array|_IH_City_C
    {
        $country = Country::query()
            ->where('country_code', '=', $request->country)
            ->first();

        return City::query()
            ->where('country_code', '=', $country->country_code)
            ->get();
    }
}
