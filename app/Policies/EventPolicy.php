<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role_id === RoleEnum::ORGANISER;
    }

    public function view(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }


    public function update(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }
}