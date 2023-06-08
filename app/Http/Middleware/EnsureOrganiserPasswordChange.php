<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class EnsureOrganiserPasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        $company = Company::where('user_id', '=', auth()->id())->first();
        if ($company->companyName === null) {
            toast('Please change your password to proceed.', 'info');

            return redirect()->route('organiser.profile', ['#company']);
        }

        return $next($request);
    }
}
