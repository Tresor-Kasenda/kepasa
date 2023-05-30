<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Events;

use App\Http\Controllers\Controller;
use App\Repository\EventUserRepository;

class ShowEventsController extends Controller
{
    public function __construct(
        protected EventUserRepository $repository
    ) {
    }

    public function __invoke(string $key)
    {
        $event = $this->repository->getEventByKey(key: $key);

        return view('apps.pages.events.show', compact('event'));
    }
}
