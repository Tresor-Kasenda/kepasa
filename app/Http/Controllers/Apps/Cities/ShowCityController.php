<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Cities;

use App\Http\Controllers\Controller;
use App\Repository\HomeRepository;
use Illuminate\Contracts\View\View;

class ShowCityController extends Controller
{
    public function __construct(public HomeRepository $repository)
    {
    }

    public function __invoke(string $city): View
    {
        $data = $this->repository->getCity($city);

        return view('apps.pages.cities.show', compact('data'));
    }
}
