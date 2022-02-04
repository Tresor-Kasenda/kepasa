<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Repository\HomeRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(public HomeRepository $repository){}

    public function __invoke(): Renderable
    {
        return view('apps.welcome', [
            'countries' => $this->repository->getCountries()
        ]);
    }

    public function getCities(Request $request): Collection|array
    {
        return Country::getCitiesInCountry($request->all());
    }
}
