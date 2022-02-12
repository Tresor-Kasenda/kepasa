<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\User;
use Illuminate\Support\Collection;

class AdminSupperRepository
{
    public function getContents(): array|Collection
    {
        return User::query()
            ->where('role_id', '=', 2)
            ->orderByDesc('created_at')
            ->get();
    }
}
