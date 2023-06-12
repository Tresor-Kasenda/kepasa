<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role_id === 4) {
            return $next($request);
        }

        if (Auth::user()->role_id === 1) {
            return redirect()->route('supper.dashboard');
        }

        if (Auth::user()->role_id === 3) {
            return redirect()->route('organiser.index');
        }
    }
}
