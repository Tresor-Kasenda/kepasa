<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Users;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Collection;

class ListUsersRepository
{
    public function users(): array|Collection
    {
        return User::query()
            ->with(
                [
                'payment',
                'company',
                'role',
                'country',
                ]
            )
            ->whereIn(
                'role_id', [
                RoleEnum::ROLE_ORGANISER,
                RoleEnum::ROLE_USERS,
                ]
            )
            ->latest()
            ->orderByDesc('created_at')
            ->get();
    }
}
