<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    public function update(User $user, City $model): bool
    {
        return RoleEnum::ROLE_SUPER === $user->role_id;
    }
}
