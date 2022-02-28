<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventSearchRequest;
use App\Repository\EventUserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    public function __construct(public EventUserRepository $repository){}

    public function __invoke(): Renderable
    {
        return view('apps.pages.events.index');
    }

    public function show(string $key): Factory|View|Application
    {
        return view('apps.pages.events.show');
    }

    public function searchEvents(EventSearchRequest $request)
    {
        $events = $this->repository->searchEvent(attributes: $request);
        if (count($events) > 0){
            $contents = view('apps.components._search', compact('events'))->render();
            return response()->json([
                'search' => $contents
            ], 200);
        }
        return response()->json([
            'messages' => "Event not exist for search"
        ]);
    }
}
