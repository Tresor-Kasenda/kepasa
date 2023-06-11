<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Country\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Repository\Suppers\Cities\UpdateCityRepository;

class UpdateCountryCityController extends Controller
{
    public function __construct(
        protected readonly UpdateCityRepository $repository
    ) {
    }

    public function __invoke(City $city, UpdateCityRequest $request)
    {
        $this->repository->updateCity($city, $request);

        toast("City updated with successful", 'success');

        return redirect()->route('supper.country-list');
    }
}
