<?php

namespace App\Repository\Suppers\Users;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Collection;

class ListUsersRepository
{
    public function users(): array|Collection
    {
        return User::query()
            ->with([
                'profile',
                'payment',
                'company',
                'role',
                'country'
            ])
            ->whereIn('role_id', [
                RoleEnum::ADMIN,
                RoleEnum::ORGANISER,
                RoleEnum::USERS
            ])
            ->orderByDesc('created_at')
            ->get();
    }
}