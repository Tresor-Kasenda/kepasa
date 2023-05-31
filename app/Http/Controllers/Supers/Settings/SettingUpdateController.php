<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\User;
use App\Repository\Suppers\SettingSupperRepository;

class SettingUpdateController extends Controller
{
    public function __construct(protected readonly SettingSupperRepository $repository)
    {
    }

    public function __invoke(User $user, SettingRequest $attributes)
    {
        $this->authorize('update', $user);

        $this->repository->update(
            $user,
            $attributes->validated()
        );

        toast('Settings is update', 'success');

        return back();
    }
}
