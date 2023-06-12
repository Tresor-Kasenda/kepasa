<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ListCountryController extends Controller
{
    public function __invoke(Request $request)
    {
        return View::make('admins.pages.countries.index');
    }
}
