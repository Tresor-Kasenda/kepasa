<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use App\Enums\ReservationEnum;
use App\Models\Event;
use App\Services\EnableX\EnableXHttpService;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EventRepository
{
    use EnableXHttpService;
    use ImageUpload;

    public function getEvents(Request $request)
    {
        return auth()
            ->user()
            ->events()
            ->with(['category', 'online', 'country', 'city'])
            ->search(
                search: $request->get('search'),
            )
            ->filters(
                filters: $request->get('filters'),
                direction: $request->get('directions', 'DESC'),
            )
            ->orderByDesc('created_at')
            ->paginate(6);
    }

    public function delete(Event $event): Event
    {
        if (false !== $event->online()->exists()) {
            $this
                ->request()
                ->delete(config('enablex.url').`rooms/${$event->online()->roomId}`);
        }

        if ($event->reservations()->where('status', ReservationEnum::STATUS_INACTIVE)) {
            throw ValidationException::withMessages(['event' => "Cannot delete this office !"])
                ->redirectTo('event/'.$event->id.'/show');
        }

        $event->delete();

        return $event;
    }
}
