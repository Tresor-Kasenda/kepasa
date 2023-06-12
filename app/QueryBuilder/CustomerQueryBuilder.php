<?php

declare(strict_types=1);

namespace App\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModelClass of Model
 *
 * @extends Builder<Model>
 */
class CustomerQueryBuilder extends Builder
{
    public function search(
        string|null $search
    ): self {
        return $this->when(
            value: $search,
            callback: function (Builder $query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query
                        ->whereHas('event', fn (Builder $builder) => $builder->where('title', 'LIKE', "%{$search}%"))
                        ->orWhereHas('user', fn (Builder $builder) => $builder->where('name', 'LIKE', "%{$search}%"));
                });
            }
        );
    }

    public function sortBy(
        string|null $sortBy,
        string|null $direction
    ): self {
        return $this->when(
            value: $sortBy === 'date',
            callback: fn (Builder $builder) => $builder->orderBy('created_at', $direction)
        );
    }
}
