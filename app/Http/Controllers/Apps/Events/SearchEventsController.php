<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventSearchRequest;
use App\Repository\EventUserRepository;

class SearchEventsController extends Controller
{
    public function __construct(
        public EventUserRepository $repository
    )
    {
    }

    public function __invoke(EventSearchRequest $request)
    {
        $events = $this->repository->searchEvent(attributes: $request);
        if (count($events) <= 0) {
            return response()->json(
                [
                    'messages' => 'Events does not exist for this town or country',
                ]
            );
        }

        return response()->json(
            [
                'search' => view(
                    'apps.components._search',
                    compact('events')
                )->render(),
            ]
        );
    }
}
