<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Repository\Suppers\CountrySupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CountrySupperController extends Controller
{
    public function __construct(public CountrySupperRepository $repository){}

    public function index(): Renderable
    {
        $countries = $this->repository->getContents();
        return view('admins.pages.countries.index', compact('countries'));
    }

    public function show(string $countryCode): Factory|View|Application
    {
        return view('admins.pages.countries.show', [
            'cities' => $this->repository->getCitiesInCountry($countryCode),
            'country' => $this->repository->getCountry($countryCode)
        ]);
    }

    public function edit(string $key): Factory|View|Application
    {
        $city = $this->repository->getSingleCity($key);
        return view('admins.pages.countries.edit', compact('city'));
    }

    public function update(string $cityName, CityRequest $attributes): RedirectResponse
    {
        $this->repository->updateCity($cityName, $attributes);
        return redirect()->back();
    }
}
