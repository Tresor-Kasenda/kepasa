<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use App\Repository\Suppers\Users\UpdateUsersRepository;

class UpdateUserController extends Controller
{
    public function __invoke(
        User $user,
        UpdateUsersRequest $request,
        UpdateUsersRepository $repository
    ) {
        $this->authorize('update', $user);

        $repository->handleUser($user, $request);

        toast("Users {$user->name} has updated with successful", 'success');

        return redirect()->route('supper.users-list');
    }
}
