<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use App\Models\Event;
use App\Services\EnableX\EnableXHttpService;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            ->withCount('payments')
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
        $files = File::exists($event->image);

        if (false !== $files) {
            $this->removePicture($event);
        }

        if (false !== $event->online()->exists()) {
            $this
                ->request()
                ->delete(config('enablex.url').`rooms/${$event->online()->roomId
        }`);
        }
        $event->delete();

        return $event;
    }
}
