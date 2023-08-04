<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user_role = Auth::user()->role_id;

        if (session()->has('url.intended')) {
            return redirect()->intended(session()->get('url.intended'));
        }

        return match ($user_role) {
            RoleEnum::ROLE_SUPER => redirect()->route('supper.dashboard'),
            RoleEnum::ROLE_ORGANISER => redirect()->route('organiser.index'),
            RoleEnum::ROLE_USERS => redirect()->route('moderator.index'),
            default => $next($request),
        };

    }
}
