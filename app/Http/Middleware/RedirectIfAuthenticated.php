<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     */
    public function handle(Request $request, Closure $next, ...$guards): Response|RedirectResponse
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && 1 === Auth::user()->role_id) {
                return redirect()->route('supper.dashboard');
            } elseif (Auth::guard($guard)->check() && 2 === Auth::user()->role_id) {
                return redirect()->route('admin.admin.index');
            } elseif (Auth::guard($guard)->check() && 3 === Auth::user()->role_id) {
                return redirect()->route('organiser.organiser.index');
            } elseif (Auth::guard($guard)->check() && 4 === Auth::user()->role_id) {
                return redirect()->route('user.home.index');
            }
        }

        return $next($request);
    }
}
