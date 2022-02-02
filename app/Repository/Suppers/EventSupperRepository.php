<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Event;
use Illuminate\Support\Collection;

class EventSupperRepository
{
    public function getContents(): array|Collection
    {
        return Event::query()
            ->orderByDesc('created_at')
            ->get();
    }
}
