<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\User;

class UpdateAdminRepository
{
    public function handleUser(User $user, $request): bool
    {
        return $user->update([
            'name' => $request['name'],
            'lastName' => $request['lastName'],
            'country_id' => $request['country'],
            'email' => $request['email'],
            'phones' => $request['phones'],
        ]);
    }
}
