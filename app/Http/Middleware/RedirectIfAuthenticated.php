<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards): Response|RedirectResponse
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && Auth::user()->role_id == 1) {
                return redirect()->route('super.dashboard.index');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == 2){
                return redirect()->route('admin.dashboard.index');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == 3){
                return redirect()->route('organiser.home.index');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == 4){
                return redirect()->route('home.user');
            }
        }

        return $next($request);
    }
}
