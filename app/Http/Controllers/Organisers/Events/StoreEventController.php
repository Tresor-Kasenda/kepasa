<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\StoreEventRequest;
use App\Repository\Organisers\Events\StoreEventRepository;

class StoreEventController extends Controller
{
    public function __invoke(
        StoreEventRequest $request,
        StoreEventRepository $repository
    ) {
        return redirect()->route('organiser.events.payment', [
            'event' => $repository->store($request)
        ]);
    }
}
