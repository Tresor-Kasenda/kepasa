<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\Request;

class EnsureStatusUsersHasActivated
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->status === UserStatus::DEACTIVATE)) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            toast("Votre compte a bien été déverrouiller, vous pouvez contactez l'administrateur !", 'danger');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
