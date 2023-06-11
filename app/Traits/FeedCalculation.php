<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\FeeOptionEnum;

trait FeedCalculation
{
    public function resolveFeeds($request): array
    {
        $prices = (int) $request->input('prices');
        $commission = $prices * (5 / 100);
        if (FeeOptionEnum::Exclusive === request()->input('feeOption')) {
            $organiser = $prices - $commission;
        } elseif (FeeOptionEnum::Inclusive === request()->input('feeOption')) {
            $organiser = $prices + $commission;
        }

        return [$commission, $organiser];
    }
}
