<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\FeeOptionEnum;

trait FeedCalculation
{
    public function resolveFeeds($request): array
    {
        $prices = (int) $request->input('prices');
        $commission = $prices * 5 / 100;
        if (request()->input('feeOption') === FeeOptionEnum::Exclusive) {
            $organiser = $prices - $commission;
        } elseif (request()->input('feeOption') === FeeOptionEnum::Inclusive) {
            $organiser = $prices + $commission;
        }

        return [$commission, $organiser];
    }
}
