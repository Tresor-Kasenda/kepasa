<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\User;
use App\Repository\UpdateAdminRepository;

class UpdateUserController extends Controller
{
    public function __construct(protected readonly UpdateAdminRepository $repository)
    {
    }

    public function __invoke(User $user, UpdateAdminRequest $request)
    {
        $this->authorize('update', $user);

        $this->repository->handleUser($user, $request->validated());

        toast("Users {$user->name} has updated with successful", 'success');

        return redirect()->route('supper.dashboard');
    }
}
