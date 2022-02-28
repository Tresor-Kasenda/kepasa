<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventUpdateRequest;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventSupperController extends Controller
{
    public function __construct(public EventSupperRepository $repository){}

    public function index(): Renderable
    {
        $events = $this->repository->getContents();
        return view('admins.pages.events.index', compact('events'));
    }

    public function show(string $key): View|Factory|Application
    {
        return view('admins.pages.events.show', [
            'event' => $this->repository->getEventByKey(key: $key)
        ]);
    }

    public function edit(string $key): Factory|View|Application
    {
        $event = $this->repository->getEventByKey(key: $key);
        return view('admins.pages.events.edit', compact('event'));
    }

    public function update(string $key, EventUpdateRequest $attributes)
    {

    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->delete(key: $key);
        return back();
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $event = $this->repository->updateStatus(request: $request);
        return response()->json([
            'messages' => "The status of the event has been successfully changed",
            'data' => $event->status
        ], 200);
    }

}
