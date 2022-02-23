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

        $prices = (int)$attributes->input('prices');
        $commission = $prices * (5 / 100);
        if (request()->input('feeOption') == FeeOptionEnum::Exclusive){
            $organiser = $prices - $commission;
        } elseif (request()->input('feeOption') == FeeOptionEnum::Inclusive){
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
