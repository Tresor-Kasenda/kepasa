<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Organisers\Events\EventRepository;
use Illuminate\Http\Request;

class DeleteEventController extends Controller
{
    public function __invoke(
        Event $event,
        EventRepository $repository
    )
    {
        $this->authorize('delete', $event);

        $repository->delete($event);

        return redirect()->route('organiser.events-list');
    }
}
