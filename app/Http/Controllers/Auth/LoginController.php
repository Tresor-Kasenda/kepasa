<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo;

    public function redirectTo(){
        $this->redirectTo = match (Auth::user()->role_id) {
            1 => '/home',
            2 => '/admin/dashboard',
            default => '/',
        };
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
