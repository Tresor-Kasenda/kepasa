<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventSupperRepository
{
    public function getContents(): Collection|array
    {
        return Event::query()
            ->orderByDesc('created_at')
            ->get();
    }
}
