<?php

declare(strict_types=1);

namespace App\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;

class EventsOrganiserQueryBuilder extends Builder
{
    public function search(
        string|null $search
    ): self {
        return $this->when(
            value: $search,
            callback: fn (Builder $query) => $query->where(function ($query) use ($search): void {
                $query
                    ->whereHas('category', fn (Builder $builder) => $builder->where('name', 'LIKE', "%{$search}%"))
                    ->orWhereHas('country', fn (Builder $builder) => $builder->where('countryName', 'LIKE', "%{$search}%"))
                    ->orWhereHas('city', fn (Builder $builder) => $builder->where('cityName', 'LIKE', "%{$search}%"));
            })
        );
    }

    public function filters(
        string|null $filters,
        string|null $direction
    ): self {
        return $this->when(
            value: 'date' === $filters,
            callback: fn (Builder $builder) => $builder->where(function (Builder $query) use ($direction): void {
                $query
                    ->orderBy('created_at', $direction)
                    ->orWhereBetween('created_at', $direction);
            })
        );
    }
}
