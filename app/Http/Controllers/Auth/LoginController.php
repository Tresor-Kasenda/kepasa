<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\RedirectAuthentication;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers, RedirectAuthentication;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
