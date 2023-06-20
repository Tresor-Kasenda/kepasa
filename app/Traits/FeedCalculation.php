<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\FeeOptionEnum;
use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait FeedCalculation
{
    public function resolveFeeds($request): array
    {
        $prices = (int) $request['prices'];
        $commission = $prices * 5 / 100;
        if (FeeOptionEnum::Exclusive === $request['fee_option']) {
            $organiser = $prices - $commission;
        } elseif (FeeOptionEnum::Inclusive === $request['fee_option']) {
            $organiser = $prices + $commission;
        }

        return [$commission, $organiser];
    }

    private function getCategory($request): null|Builder|Model
    {
        return Category::find($request['category']);
    }

    private function getCity($request): Model|Collection|City|array|null
    {
        return City::find($request['city']);
    }
}
