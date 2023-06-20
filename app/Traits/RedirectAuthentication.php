<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\RoleEnum;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

trait RedirectAuthentication
{
    protected string $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(): string
    {
        switch (Auth::user()->role_id) {
        case RoleEnum::ROLE_USERS:
            $this->redirectTo = route('user.home.index');
            return $this->redirectTo;
                break;
        case RoleEnum::ROLE_ORGANISER:
            $this->redirectTo = route('organiser.index');
            return $this->redirectTo;
                break;
        case RoleEnum::ROLE_SUPER:
            $this->redirectTo = route('supper.dashboard');
            return $this->redirectTo;
                break;
        default:
            $this->redirectTo = route('login');
            return $this->redirectTo;
        }
    }
}
