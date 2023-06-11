<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\View;

class ShowEventController extends Controller
{
    public function __invoke(Event $event)
    {
        return View::make('organisers.pages.events.show', [
            'event' => $event->load(['category', 'online', 'media', 'country', 'city'])
        ]);
    }
}
