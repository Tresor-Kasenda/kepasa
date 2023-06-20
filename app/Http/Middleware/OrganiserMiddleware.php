<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganiserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (RoleEnum::ROLE_SUPER === Auth::user()->role_id) {
            return redirect()->route('supper.dashboard');
        }

        if (RoleEnum::ROLE_ORGANISER === Auth::user()->role_id) {
            return $next($request);
        }

        if (RoleEnum::ROLE_USERS === Auth::user()->role_id) {
            return redirect()->route('user.home.index');
        }
    }
}
