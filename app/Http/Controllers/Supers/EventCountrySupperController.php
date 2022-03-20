<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventCountrySupperRepository;
use Illuminate\Contracts\Support\Renderable;

class EventCountrySupperController extends Controller
{
    public function __construct(public EventCountrySupperRepository $repository){}

    public function index(): Renderable
    {
        return view('admins.pages.eventCountries.index', [
            'events' => $this->repository->getContents()
        ]);
    }

    public function show(string $country): Renderable
    {
        return view('admins.pages.eventCountries.show', [
            'events' => $this->repository->getEventByCountry(country: $country)
        ]);
    }
}
