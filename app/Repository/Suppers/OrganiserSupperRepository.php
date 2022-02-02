<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\User;
use Illuminate\Support\Collection;

class OrganiserSupperRepository
{
    public function getContents(): array|Collection
    {
        return User::query()
            ->orderByDesc('created_at')
            ->get();
    }
}
