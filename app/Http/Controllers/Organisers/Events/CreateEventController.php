<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\CategorySupperRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CreateEventController extends Controller
{
    public function __construct(
        protected readonly CategorySupperRepository $repository,
    ) {
    }

    public function __invoke(Request $request)
    {
        return View::make('organisers.pages.events.create', [
            'categories' => $this->repository->getContents()
        ]);
    }
}
