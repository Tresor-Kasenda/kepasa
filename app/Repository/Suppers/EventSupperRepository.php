<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EventSupperRepository
{
    public function getContents(): array|Collection
    {
        return Event::query()
            ->with(['category', 'media'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function getEventByKey(string $key): Model|Builder
    {
        $event = Event::query()
            ->where('key', '=', $key)
            ->firstOrFail();
        return $event->load(['category', 'media', 'user']);
    }
}
