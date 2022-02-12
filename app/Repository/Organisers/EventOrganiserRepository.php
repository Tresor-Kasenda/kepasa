<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EventOrganiserRepository
{
    public function getContents(): Collection|array
    {
        return Event::query()
            ->with(['category', 'media', 'billings'])
            ->where('user_id', '=', request()->user()->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getEventById(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('key', '=', $key)
            ->firstOrFail();
        return $event->load(['category', 'media', 'billings']);
    }

    public function store($attributes)
    {

    }
}
