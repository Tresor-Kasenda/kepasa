<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apps\Cities;

use App\Http\Controllers\Controller;
use App\Repository\HomeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function __construct(public HomeRepository $repository)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data['cities'] = $this->repository->getCitiesInCountry($request);

        return response()->json(
            [
            'views' => view(
                'apps.components._select',
                compact('data')
            )->render(),
            'status' => true,
            ]
        );
    }
}
