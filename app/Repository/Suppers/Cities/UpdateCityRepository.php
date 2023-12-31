<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Cities;

use App\Enums\CityEnum;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Traits\ImageUpload;

class UpdateCityRepository
{
    use ImageUpload;

    public function updateCity(City $city, UpdateCityRequest $validated): void
    {
        $city->update(
            [
                'city_name' => $validated->input('cityName'),
                'facts' => $validated->input('facts'),
                'overview' => $validated->input('overview'),
                'currency' => $validated->input('currency'),
                'history' => $validated->input('history'),
                'languages' => $validated->input('language'),
                'population' => $validated->input('population'),
                'popular_city' => $validated->input('popular_city'),
                'mayor' => $validated->input('mayor'),
                'country_code' => $validated->input('country_code'),
                'image' => self::uploadProfile($validated),
                'promoted' => self::statusCity($validated),
            ]
        );
    }

    protected static function statusCity($validated): string
    {
        if ('on' === $validated->input('promoted')) {
            return CityEnum::APPROVAL_PROMOTION->value;
        }
        return CityEnum::APPROVAL_NOT_PROMOTION->value;
    }
}
