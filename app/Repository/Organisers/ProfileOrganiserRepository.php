<?php

declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ProfileOrganiserRepository
{
    public function updatePassword(string $key, $attributes): Model|Builder
    {
        $user = User::query()
            ->where('key', '=', $key)
            ->firstOrFail();
        $user->update([
            'password' => Hash::make($attributes->input('password')),
        ]);

        return $user;
    }

    public function updateProfile(User $user, UpdateProfileRequest $request): User
    {
        $user->update([
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phones' => $request->input('phones'),
            'country_id' => $request->input('country'),
        ]);

        return $user;
    }
}
