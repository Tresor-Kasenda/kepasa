<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Enums\RoleEnum;
use App\Enums\UserStatus;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Notifications\UserPendingApprovalNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ProfileOrganiserRepository
{
    public function updatePassword(User $user, $attributes): Model|Builder
    {
        $user->update(
            [
                'password' => Hash::make($attributes->input('password')),
            ]
        );

        return $user;
    }

    public function updateProfile(User $user, UpdateProfileRequest $request): User
    {
        $user->fill($request->validated());

        if ($requires = $user->isDirty(['email', 'phones', 'country_id'])) {
            $user->fill(['status' => UserStatus::STATUS_DEACTIVATE]);
        }

        $user->update(
            [
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phones' => $request->input('phones'),
                'country_id' => $request->input('country'),
            ]
        );

        if ($requires) {
            Notification::send(
                User::where('role_id', RoleEnum::ROLE_SUPER)->first(),
                new UserPendingApprovalNotification($user)
            );
        }

        return $user;
    }
}
