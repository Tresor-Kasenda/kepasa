<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Repository\Organisers\Events\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ListEventsController extends Controller
{
    public function __invoke(Request $request, EventRepository $repository)
    {
        return View::make('organisers.pages.events.index', [
            'events' => $repository->getEvents($request),
        ]);
    }
}
