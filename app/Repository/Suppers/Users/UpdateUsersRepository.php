<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Users;

use App\Events\UpdateUserEvent;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use App\Traits\ImageUpload;

class UpdateUsersRepository
{
    use ImageUpload;

    public function handleUser(User $user, UpdateUsersRequest $request): User
    {
        if (null !== $user->images) {
            $this->removePicture($user);
        }

        $user->update([
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'country_id' => $request->input('country'),
            'email' => $request->input('email'),
            'phones' => $request->input('phones'),
            'images' => self::uploadProfile($request)
        ]);
        event(new UpdateUserEvent($user));

        return $user;
    }
}
