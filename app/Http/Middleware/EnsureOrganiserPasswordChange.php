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
        $company = Company::where('user_id', '=', auth()->id())->first();
        if (null === $company->companyName) {
            toast('Please change your password to proceed.', 'info');

            return redirect()->route('organiser.profile', ['#company']);
        }

        return $next($request);
    }
}
