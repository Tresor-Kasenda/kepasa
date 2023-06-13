<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class EnsureOrganiserPasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (
            $user &&
            !Company::where('user_id', $user->id)
                ->whereNotNull('name')
                ->whereNotNull('email')
                ->exists()
        ) {
            return redirect()->route('organiser.profile', ['#profile'])
                ->with('danger', 'Please update your company details before continuing.');
        }

        return $next($request);
    }
}
