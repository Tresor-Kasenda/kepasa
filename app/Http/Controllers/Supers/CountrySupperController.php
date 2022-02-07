<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\CountrySupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CountrySupperController extends Controller
{
    public function __construct(public CountrySupperRepository $repository){}

    public function __invoke(): Renderable
    {
        $countries = $this->repository->getContents();
        return view('admins.pages.countries.index', compact('countries'));
    }

    public function show(string $countryCode): Factory|View|Application
    {
        return view('admins.pages.countries.show', [
            'cities' => $this->repository->getCitiesInCountry($countryCode)
        ]);
    }
}
