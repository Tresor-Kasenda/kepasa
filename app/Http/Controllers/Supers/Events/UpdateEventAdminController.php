<?php

namespace App\Http\Controllers\Supers\Events;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\CategorySupperRepository;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UpdateEventAdminController extends Controller
{
    public function __construct(
        public EventSupperRepository $repository,
        public CategorySupperRepository $categorySupperRepository
    ) {
    }

    public function __invoke(string $key): Factory|View|Application
    {
        return view('admins.pages.events.edit', [
            'event' => $this->repository->getEventByKey(key: $key),
            'categories' => $this->categorySupperRepository->getContents(),
        ]);
    }
}
