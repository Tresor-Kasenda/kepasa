<?php

namespace App\Http\Controllers\Apps\Promoted;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PromotedController extends Controller
{

    public function __invoke(): Renderable
    {
        return view('apps.pages.cities.index');
    }
}
