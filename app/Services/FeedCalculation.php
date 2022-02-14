<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\FeeOptionEnum;

trait FeedCalculation
{
    public function feedCalculationEvent($attributes): array
    {
        $country = $this->getCountry($attributes);
        $city = $this->getCity($attributes, $country);

        $prices = $attributes->input('prices');
        if (request()->input('feeOption') == FeeOptionEnum::Exclusive){
            $commission = (5 / 100) * $prices;
            $organiser = $prices - $commission;
        } elseif (request()->input('feeOption') == FeeOptionEnum::Inclusive){
            $commission = (5 / 100) * $prices;
            $organiser = $prices + $commission;
        }

        return [
            $country,
            $city,
            $commission,
            $organiser
        ];
    }
}
