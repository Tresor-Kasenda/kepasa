<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Suppers\CategorySupperRepository;
use Illuminate\Support\Facades\View;

class EditEventController extends Controller
{
    public function __invoke(
        Event $event,
        CategorySupperRepository $repository
    ) {
        $this->authorize('update', $event);

        return View::make(
            'organisers.pages.events.edit',
            [
                'event' => $event->load(['category', 'online', 'country', 'city']),
                'categories' => $repository->getContents(),
            ]
        );
    }
}
