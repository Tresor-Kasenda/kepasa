<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Suppers\Users\DeleteUserRepository;

class DeleteUserController extends Controller
{
    public function __invoke(User $user, DeleteUserRepository $repository)
    {
        $this->authorize('delete', $user);

        $repository->delete($user);

        toast("User has deleted with successful", 'success');

        return redirect()->route('supper.users-list');
    }
}
