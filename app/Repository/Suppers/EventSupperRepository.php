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
        $event = $this->getFirstOrFail($key);
        return $event->load(['category', 'media', 'user']);
    }

    public function delete(string $key): Model|Builder
    {
        $event = $this->getFirstOrFail(key: $key);
        $event->delete();
        toast("delete event with success", 'success');
        return $event;
    }

    public function updateStatus($request): bool|int
    {
        $event = $this->getFirstOrFail(key: $request->input('key'));
        return $event->update([
            'status' => $request->input('id')
        ]);
    }

    private function getFirstOrFail(string $key): Builder|Model
    {
        return Event::query()
            ->where('key', '=', $key)
            ->firstOrFail();
    }
}
