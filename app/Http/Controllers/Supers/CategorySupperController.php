<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repository\Suppers\CategorySupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategorySupperController extends Controller
{
    public function __construct(public CategorySupperRepository $repository)
    {
    }

    public function index(): Renderable
    {
        $categories = $this->repository->getContents();

        return view('admins.pages.categories.index', compact('categories'));
    }

    public function create(): Factory|View|Application
    {
        return view('admins.pages.categories.create');
    }

    public function store(CategoryRequest $attributes): RedirectResponse
    {
        $this->repository->create($attributes);

        return redirect()->route('supper.category.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $category = $this->repository->getSingleCategory($key);

        return view('admins.pages.categories.edit', compact('category'));
    }

    public function update(string $key, CategoryRequest $attributes): RedirectResponse
    {
        $this->repository->update($key, $attributes);

        return redirect()->route('supper.category.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->delete($key);

        return redirect()->route('supper.category.index');
    }
}
