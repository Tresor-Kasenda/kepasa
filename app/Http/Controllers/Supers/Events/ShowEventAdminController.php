<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Suppers\EventSupperRepository;

class ShowEventAdminController extends Controller
{
    public function __construct(
        public EventSupperRepository $repository,
    ) {
    }

    public function __invoke(Event $event)
    {
        return view(
            'admins.pages.events.show', [
            'event' => $event->load(['category', 'user', 'company', 'country', 'city']),
            ]
        );
    }
}
