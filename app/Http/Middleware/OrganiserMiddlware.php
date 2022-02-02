<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrganiserMiddlware
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
            1 => redirect()->route('supper.dashboard.index'),
            2 => redirect()->route('admin.admin.index'),
            3 => $next($request),
            4 => redirect()->route('user.home.index'),
            default => redirect()->route('login'),
        };
    }
}
