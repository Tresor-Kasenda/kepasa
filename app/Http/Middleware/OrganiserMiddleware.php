<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganiserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ( ! Auth::check()) {
            return redirect()->route('login');
        }

        if (1 === Auth::user()->role_id) {
            return redirect()->route('supper.dashboard');
        }

        if (3 === Auth::user()->role_id) {
            return $next($request);
        }

        if (4 === Auth::user()->role_id) {
            return redirect()->route('user.home.index');
        }
    }
}
