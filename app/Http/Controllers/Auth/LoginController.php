<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo;

    public function redirectTo(){
        $this->redirectTo = match (Auth::user()->role_id) {
            1 => route('supper.dashboard.index'),
            2 => route('admin.admin.index'),
            3 => route('organiser.organiser.index'),
            4 => route('user.home.index')
        };
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
