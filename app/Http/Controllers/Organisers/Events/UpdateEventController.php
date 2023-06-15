<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\EventUpdateRequest;
use App\Models\Event;
use App\Repository\Organisers\Events\UpdateEventRepository;
use Illuminate\Http\Response;

class UpdateEventController extends Controller
{
    public function __invoke(
        Event $event,
        EventUpdateRequest $request,
        UpdateEventRepository $repository
    ) {
        abort_unless(auth()->id(), Response::HTTP_FORBIDDEN);

        $this->authorize('update', $event);

        $repository->handle($request, $event);

        return redirect()->route('organiser.events-list');
    }
}
