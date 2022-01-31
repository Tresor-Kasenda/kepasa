<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if(!Auth::check()){return redirect()->route('login');}
        return match (Auth::user()->role_id) {
            1 => $next($request),
            2 => redirect()->route('admin.dashboard.index'),
            3 => redirect()->route('organiser.home.index'),
            4 => redirect()->route('data.user'),
            default => redirect()->route('login'),
        };
    }
}
