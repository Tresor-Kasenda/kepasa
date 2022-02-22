<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SuperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if (Auth::user()->role_id == 1) {
            return $next($request);
        }

        if (Auth::user()->role_id == 2) {
            return redirect()->route('admin.admin.index');
        }

        if (Auth::user()->role_id == 3){
            return redirect()->route('organiser.home.index');
        }

        if (Auth::user()->role_id == 4){
            return redirect()->route('user.home.index');
        }
    }
}
