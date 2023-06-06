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
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }
}
