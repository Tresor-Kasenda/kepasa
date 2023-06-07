<?php

namespace App\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModelClass of Model
 *
 * @extends Builder<Model>
 *
 */
class InvoiceQueryBuilder extends Builder
{
    public function search(
        string|null $search
    ): self {
        return $this->when(
            value: $search,
            callback: function (Builder $query) use ($search){
                $query->where(function ($query) use ($search) {
                    $query
                        ->whereHas('event', fn(Builder $builder) => $builder->where('title', 'LIKE', "%$search%"))
                        ->orWhereHas('user', fn(Builder $builder) => $builder->where('name','LIKE', "%$search%"));
                });
        });
    }

    public function sortBy(
        string|null $sortBy,
        string|null $direction
    ): self {
        return $this->when(
            value: $sortBy === 'date',
            callback: fn(Builder $builder) => $builder->orderBy('created_at', $direction)
        );
    }
}
