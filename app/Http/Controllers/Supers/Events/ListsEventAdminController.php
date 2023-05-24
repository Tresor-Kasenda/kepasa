<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Events;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Http\Request;

class ListsEventAdminController extends Controller
{
    public function __construct(
        public EventSupperRepository $repository,
    ) {
    }

    public function __invoke(Request $request)
    {
        $events = $this->repository->getContents();

        return view('admins.pages.events.index', compact('events'));
    }
}
