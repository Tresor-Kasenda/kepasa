<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Contracts\Support\Renderable;

class CityAdminController extends Controller
{
    public function __invoke(City $city): Renderable
    {
        return view('supervisor.pages.cities.index');
    }
}
