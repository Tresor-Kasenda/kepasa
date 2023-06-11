<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Cities;

use App\Enums\CityPromotedEnum;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Traits\ImageUpload;

class UpdateCityRepository
{
    use ImageUpload;

    public function updateCity(City $city, UpdateCityRequest $validated): void
    {
        $city->update([
            'cityName' => $validated->input('cityName'),
            'facts' => $validated->input('facts'),
            'overview' => $validated->input('overview'),
            'currency' => $validated->input('currency'),
            'history' => $validated->input('history'),
            'languages' => $validated->input('language'),
            'population' => $validated->input('population'),
            'popularCity' => $validated->input('popular_city'),
            'mayor' => $validated->input('mayor'),
            'countryCode' => $validated->input('country_code'),
            'image' => self::uploadProfile($validated),
            'promoted' => self::statusCity($validated)
        ]);
    }

    protected static function statusCity($validated): string
    {
        if ('on' === $validated->input('promoted')) {
            return CityPromotedEnum::PROMOTION;
        }
        return CityPromotedEnum::NOTPROMOTED;
    }
}
