<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    public function __invoke(): Renderable
    {
        return view('apps.pages.events.index');
    }

    public function show(string $key): Factory|View|Application
    {
        return view('apps.pages.events.show');
    }
}
