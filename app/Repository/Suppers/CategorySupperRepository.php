<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Category_QB;

class CategorySupperRepository
{
    public function getContents(): Collection|array
    {
        return Category::query()
            ->latest()
            ->orderByDesc('created_at')
            ->get();
    }

    public function store(array $validated): Model|Builder|_IH_Category_QB|Category
    {
        return Category::query()
            ->create([
                'name' => $validated['name'],
            ]);
    }
}
