<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategorySupperRepository
{
    public function getContents(): Collection|array
    {
        return Category::query()
            ->latest()
            ->orderByDesc('created_at')
            ->get();
    }

    public function store(array $validated)
    {
        return Category::query()
            ->create([
                'name' => $validated['name']
            ]);
    }
}
