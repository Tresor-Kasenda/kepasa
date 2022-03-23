<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Event;
use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EventSupperRepository
{
    use ImageUpload;

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
        $this->removePicture($event);
        $event->delete();
        toast("delete event with success", 'success');
        return $event;
    }

    private function getFirstOrFail(string $key): Builder|Model
    {
        return Event::query()
            ->where('key', '=', $key)
            ->firstOrFail();
    }
}
