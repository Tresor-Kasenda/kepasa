<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpdateProfilePolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model): bool
    {
        return $user->id === auth()->id();
    }

    public function delete(User $user, User $model): bool
    {
        return $user->id === auth()->id();
    }
}
