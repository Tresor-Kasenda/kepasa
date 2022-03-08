<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategorySupperRepository
{
    public function getContents(): Collection|array
    {
        return Category::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function create($attributes): Model|Builder
    {
        $category = Category::query()
            ->create([
                'name' => $attributes->input('name')
            ]);
        toast('New category as stored', 'success');
        return $category;
    }

    public function update(string $key, $attributes): Model|Builder|null
    {
        $category = $this->getSingleCategory($key);
        $category->update([
            'name' => $attributes->input('name')
        ]);
        toast('Category has updated', 'success');
        return $category;
    }

    public function delete(string $key): Model|Builder|null
    {
        $category = $this->getSingleCategory($key);
        $category->delete();
        toast('category as deleted', 'info');
        return $category;
    }

    public function getSingleCategory(string $key): null|Builder|Model
    {
        return Category::query()
            ->where('key', '=', $key)
            ->first();
    }
}
