<?php

declare(strict_types=1);

namespace App\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;

class CompanyQueryBuilder extends Builder
{
    public function search(
        string|null $search
    ) {
        return $this->when(
            $search, function (Builder $query) use ($search): void {
                $query->where('companyName', 'LIKE', "%.{$search}.%")
                    ->orWhereHas('user', fn ($query) => $query->where('name', 'LIKE', "%{$search}%"));
            }
        );
    }
}
