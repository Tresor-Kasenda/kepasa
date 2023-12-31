<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @param  Request                                       $request
     * @param  Closure(Request): (Response|RedirectResponse) $next
     * @param  string|null                                   ...$guards
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards): Response|RedirectResponse
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && RoleEnum::ROLE_SUPER === Auth::user()->role_id) {
                return redirect()->route('supper.dashboard');
            } elseif (Auth::guard($guard)->check() && RoleEnum::ROLE_ORGANISER === Auth::user()->role_id) {
                return redirect()->route('organiser.index');
            } elseif (Auth::guard($guard)->check() && RoleEnum::ROLE_USERS === Auth::user()->role_id) {
                return redirect()->route('user.home.index');
            }
        }

        return $next($request);
    }
}
