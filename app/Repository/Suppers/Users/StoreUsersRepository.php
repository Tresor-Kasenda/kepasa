<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Users;

use App\Enums\RoleEnum;
use App\Mail\CreatedAdminEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StoreUsersRepository
{
    public function created(array $validated)
    {
        $users = User::query()
            ->create([
                'name' => $validated['name'],
                'lastName' => $validated['lastName'],
                'email' => $validated['email'],
                'phones' => $validated['phones'],
                'country_id' => $validated['country'],
                'password' => Hash::make($validated['password']),
                'role_id' => RoleEnum::ROLE_SUPER,
            ]);
        Mail::send(new CreatedAdminEmail($users));
        return $users;
    }
}
