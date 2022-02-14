<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Repository\HomeRepository;
use App\Repository\Organisers\EventOrganiserRepository;
use App\Repository\Suppers\CategorySupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventOrganiserController extends Controller
{
    public function __construct(
        public HomeRepository $repository,
        public CategorySupperRepository $categorySupperRepository,
        public EventOrganiserRepository $organiserRepository
    ){}

    public function index(): Renderable
    {
        return view('organisers.pages.events.index', [
            'events' => $this->organiserRepository->getContents()
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('organisers.pages.events.create', [
            'countries' => $this->repository->getCountries(),
            'categories' => $this->categorySupperRepository->getContents()
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('organisers.pages.events.show', [
            'event' => $this->organiserRepository->getEventById($key)
        ]);
    }

    public function store(EventRequest $attributes): RedirectResponse
    {
        $event = $this->organiserRepository->store($attributes);
        return redirect()->route('organiser.events.payment.index', compact('event'));
    }

    public function edit(string $key): Factory|View|Application
    {
        return view('organisers.pages.events.edit', [
            'event' => $this->organiserRepository->getEventById($key),
            'countries' => $this->repository->getCountries(),
            'categories' => $this->categorySupperRepository->getContents()
        ]);
    }

    public function update(string $key, EventRequest $attributes): RedirectResponse
    {
        $this->organiserRepository->updateEvent(key: $key, attributes: $attributes);
        return redirect()->route('organiser.events.index');
    }
}
