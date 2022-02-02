<?php
declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Contracts\Support\Renderable;

class EventSupperController extends Controller
{
    public function __construct(public EventSupperRepository $repository){}

    public function __invoke(): Renderable
    {
        $events = $this->repository->getContents();
        return view('admins.pages.events.index', compact('events'));
    }
}
