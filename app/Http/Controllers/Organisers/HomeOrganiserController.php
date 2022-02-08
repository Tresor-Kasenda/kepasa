<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class HomeOrganiserController extends Controller
{
    public function index(): Renderable
    {
        return view('organisers.dashboard');
    }
}
