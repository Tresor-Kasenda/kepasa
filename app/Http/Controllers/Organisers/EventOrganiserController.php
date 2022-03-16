<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Repository\Organisers\EventOrganiserRepository;
use App\Repository\Suppers\CategorySupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EventOrganiserController extends Controller
{
    public function __construct(
        public CategorySupperRepository $categorySupperRepository,
        public EventOrganiserRepository $organiserRepository
    ){}

    public function index(): Renderable
    {
        return view('organisers.pages.events.index', [
            'events' => $this->organiserRepository->getContents()
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('organisers.pages.events.show', [
            'event' => $this->organiserRepository->getEventById(key: $key)
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('organisers.pages.events.create', [
            'categories' => $this->categorySupperRepository->getContents()
        ]);
    }

    public function store(EventRequest $attributes): RedirectResponse
    {
        $event = $this->organiserRepository->storeEvents(attributes: $attributes);
        return redirect()->route('organiser.events.payment.index', compact('event'));
    }

    public function edit(string $key): Factory|View|Application
    {
        return view('organisers.pages.events.edit', [
            'event' => $this->organiserRepository->getEventById(key: $key),
            'categories' => $this->categorySupperRepository->getContents()
        ]);
    }

    public function update(string $key, EventUpdateRequest $attributes): RedirectResponse
    {
        $this->organiserRepository->updateEvent(key: $key, attributes: $attributes);
        return redirect()->route('organiser.events.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->organiserRepository->deletedEvent(key: $key);
        return redirect()->route('organiser.events.index');
    }
}
