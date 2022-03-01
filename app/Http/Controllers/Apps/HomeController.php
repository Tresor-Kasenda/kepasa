<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Repository\HomeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(public HomeRepository $repository){}

    public function __invoke(): Renderable
    {
        return view('apps.welcome', [
            'cities' => $this->repository->getCities()
        ]);
    }

    public function getCities(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['cities'] = $this
            ->repository
            ->getCitiesInCountry($request);
        $views = view('apps.components._select', compact('data'))->render();
        return response()->json([
            'views' => $views,
            'status' => true
        ]);
    }

    public function detailsCity(string $city): Factory|View|Application
    {
        $data = $this->repository->getCity($city);
        return view('apps.pages.cities.show', compact('data'));
    }
}
