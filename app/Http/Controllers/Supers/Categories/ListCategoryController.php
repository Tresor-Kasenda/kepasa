<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Categories;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\CategorySupperRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;

class ListCategoryController extends Controller
{
    public function __construct(
        protected readonly CategorySupperRepository $repository
    ) {
    }

    public function __invoke(): Renderable
    {
        return View::make('admins.pages.categories.index', [
            'categories' => $this->repository->getContents(),
        ]);
    }
}
