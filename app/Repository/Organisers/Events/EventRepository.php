<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use App\Enums\PaymentEnum;
use App\Models\Event;
use App\Services\EnableX\EnableXHttpService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use LaravelIdea\Helper\App\Models\_IH_Event_C;

class EventRepository
{
    use EnableXHttpService;

    public function getEvents(Request $request): LengthAwarePaginator|_IH_Event_C|array
    {
        return Event::query()
            ->where('user_id', '=', auth()->id())
            ->with(['category', 'online', 'city'])
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
                ->delete(config('enablex.url').`rooms/{${$event->online()->roomId}}`);
        }

        if ($event->customers()->where('status', PaymentEnum::UNPAID)) {
            throw ValidationException::withMessages(['event' => "Cannot delete this office !"])
                ->redirectTo('event/'.$event->id.'/show');
        }

        $event->delete();

        return $event;
    }
}
