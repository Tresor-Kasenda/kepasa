<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CreateEventController extends Controller
{
    public function __invoke(Request $request)
    {
        return View::make(
            'organisers.pages.events.create', [
            'categories' => Category::all(),
            'cities' => City::orderBy('city_name', 'asc')->get()
            ]
        );
    }
}
