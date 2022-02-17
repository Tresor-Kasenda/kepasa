<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EventSupperController extends Controller
{
    public function __construct(public EventSupperRepository $repository){}

    public function index(): Renderable
    {
        $events = $this->repository->getContents();
        return view('admins.pages.events.index', compact('events'));
    }

    public function show(string $key): View|Factory|Application
    {
        return view('admins.pages.events.show', [
            'event' => $this->repository->getEventByKey(key: $key)
        ]);
    }
}
