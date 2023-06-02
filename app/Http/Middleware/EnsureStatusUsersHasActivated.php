<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
