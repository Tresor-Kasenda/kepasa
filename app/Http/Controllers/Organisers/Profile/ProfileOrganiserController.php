<?php

namespace App\Http\Controllers\Organisers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProfileOrganiserController extends Controller
{
    public function __invoke(Request $request): Renderable
    {
        return View::make('organisers.pages.profiles.index');
    }
}
