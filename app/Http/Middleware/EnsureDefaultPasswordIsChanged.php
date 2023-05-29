<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class EnsureDefaultPasswordIsChanged
{
    public function handle(Request $request, Closure $next)
    {
        if (Hash::check('password', auth()->user()->password)) {
            toast('Please change your password to proceed.', 'info');

            return redirect()->route('supper.settings.index', ['#password']);
        }

        return $next($request);
    }
}
