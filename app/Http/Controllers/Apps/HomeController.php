<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Repository\HomeRepository;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(public HomeRepository $repository)
    {
    }

    public function __invoke(): View
    {
        return view(
            'apps.welcome', [
            'cities' => $this->repository->getCities(),
            'countries' => $this->repository->getCountries(),
            'events' => $this->repository->getContents()
            ]
        );
    }
}
