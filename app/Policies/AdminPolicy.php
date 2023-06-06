<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $model): bool
    {
        return RoleEnum::SUPER === $user->role_id;
    }

    public function update(User $user, User $model): bool
    {
        return RoleEnum::SUPER === $user->role_id;
    }

    public function delete(User $user, User $model): bool
    {
        return RoleEnum::SUPER === $user->role_id;
    }
}
