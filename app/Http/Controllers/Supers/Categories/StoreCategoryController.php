<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repository\Suppers\CategorySupperRepository;

class StoreCategoryController extends Controller
{
    public function __invoke(CategoryRequest $request, CategorySupperRepository $repository)
    {
        $repository->store($request->validated());

        toast('New category as stored', 'success');

        return redirect()->route('supper.category-list');
    }
}
