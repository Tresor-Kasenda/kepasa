<?php

namespace App\Http\Controllers\Supers\Events;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\EventSupperRepository;
use Illuminate\Http\Request;

class ShowEventAdminController extends Controller
{
    public function __construct(
        public EventSupperRepository $repository,
    ) {
    }

    public function __invoke(string $key)
    {
        return view('admins.pages.events.show', [
            'event' => $this->repository->getEventByKey(key: $key),
        ]);
    }
}