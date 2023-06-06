<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;

class CreateCategoryController extends Controller
{
    public function __invoke(): Renderable
    {
        return View::make('admins.pages.categories.create');
    }
}
