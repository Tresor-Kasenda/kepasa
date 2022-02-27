<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Contracts\Support\Renderable;

class CityAdminController extends Controller
{
    public function index(City $city): Renderable
    {
        dd($city);
        return view('supervisor.pages.cities.index');
    }
}
