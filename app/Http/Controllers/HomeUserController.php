<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeUserController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('users.home');
    }
}
