<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventCountrySupperRepository;
use Illuminate\Contracts\Support\Renderable;

class EventCountrySupperController extends Controller
{
    public function __construct(public EventCountrySupperRepository $repository){}

    public function __invoke(): Renderable
    {
        $countries = $this->repository->getContents();
        return view('admins.pages.eventCountries.index', compact('countries'));
    }
}
