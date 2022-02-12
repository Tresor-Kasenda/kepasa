<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
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
        return view('organisers.pages.events.index');
    }

    public function create(): Factory|View|Application
    {
        return view('organisers.pages.events.create', [
            'countries' => $this->repository->getCountries(),
            'categories' => $this->categorySupperRepository->getContents()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $event = $this->organiserRepository->store(attributes: $request);
        return redirect()->route('organiser.events.payment.index', compact($event));
    }
}
