<?php

declare(strict_types=1);

namespace App\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

trait RedirectAuthentication
{
    protected string $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(): string
    {
        switch (Auth::user()->role_id) {
            case 4:
                $this->redirectTo = route('user.home.index');

                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = route('organiser.index');

                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = route('admin.admin.index');

                return $this->redirectTo;
                break;
            case 1:
                $this->redirectTo = route('supper.dashboard');

                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = route('login');

                return $this->redirectTo;
        }
    }
}
