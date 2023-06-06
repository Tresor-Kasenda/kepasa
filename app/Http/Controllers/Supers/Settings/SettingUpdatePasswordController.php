<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;
use App\Models\User;
use App\Repository\UpdatePasswordRepository;

class SettingUpdatePasswordController extends Controller
{
    public function __construct(
        protected readonly UpdatePasswordRepository $repository
    ) {
    }

    public function __invoke(User $user, UpdatePassword $request)
    {
        $this->authorize('update', $user);

        $this->repository->reset(
            $user,
            $request->validated()
        );

        return back();
    }
}
