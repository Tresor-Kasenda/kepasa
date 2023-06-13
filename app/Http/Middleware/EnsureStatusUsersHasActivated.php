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
        if (auth()->check() && (UserStatus::STATUS_DEACTIVATE->value === auth()->user()->status)) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()
                ->route('login')
                ->with('error', 'Your account has been deactivated. Please contact the administrator.');
        }

        return $next($request);
    }
}
