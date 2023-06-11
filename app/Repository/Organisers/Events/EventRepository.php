<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Events;

use Illuminate\Http\Request;

class EventRepository
{
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
}
