<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ( ! Auth::check()) {
            return redirect()->route('login');
        }

        if (4 === Auth::user()->role_id) {
            return $next($request);
        }

        if (1 === Auth::user()->role_id) {
            return redirect()->route('supper.dashboard');
        }

        if (2 === Auth::user()->role_id) {
            return redirect()->route('admin.admin.index');
        }

        if (3 === Auth::user()->role_id) {
            return redirect()->route('organiser.organiser.index');
        }
    }
}
