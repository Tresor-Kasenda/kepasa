<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Events;

use App\Http\Controllers\Controller;
use App\Repository\EventUserRepository;
use Illuminate\Http\Request;

class ListEventsController extends Controller
{
    public function __construct(
        protected EventUserRepository $repository
    ) {
    }

    public function __invoke(Request $request)
    {
        $events = $this->repository->getContents();

        return view('apps.pages.events.index', compact('events'));
    }
}
