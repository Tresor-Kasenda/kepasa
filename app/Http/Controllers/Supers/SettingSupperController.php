<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\UpdatePassword;
use App\Repository\Suppers\SettingSupperRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class SettingSupperController extends Controller
{
    public function __construct(public SettingSupperRepository $repository)
    {
    }

    public function __invoke(): Renderable
    {
        return view('admins.pages.settings.index');
    }

    public function storeApps(string $key, SettingRequest $attributes): RedirectResponse
    {
        $this->repository->update(key: $key, attributes: $attributes);

        return back();
    }

    public function updatePassword(string $key, UpdatePassword $request): RedirectResponse
    {
        $this->repository->updatePassword(key: $key, attributes: $request);

        return back();
    }
}
