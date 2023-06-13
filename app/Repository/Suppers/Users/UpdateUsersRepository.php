<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Users;

use App\Events\UpdateUserEvent;
use App\Http\Requests\Admin\UpdateUsersRequest;
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
            'last_name' => $request->input('lastName'),
            'country_id' => $request->input('country'),
            'email' => $request->input('email'),
            'phones' => $request->input('phones'),
        ]);
        $user->notify(new UpdateUserEvent($user));

        return $user;
    }
}
