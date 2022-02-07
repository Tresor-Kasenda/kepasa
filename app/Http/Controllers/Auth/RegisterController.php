<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var string
     */
    protected $redirectTo;

    public function redirectTo(){
        $this->redirectTo = match (Auth::user()->role_id) {
            1 => route('supper.dashboard.index'),
            2 => route('admin.admin.index'),
            3 => route('organiser.organiser.index'),
            4 => route('user.home.index'),
            default => route('home.index'),
        };
    }

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'lastName' => ['required', 'string', 'max:255'],
            'phones' => ['required', 'min:10']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Builder|Model
     */
    protected function create(array $data): Model|Builder
    {
        $user = User::query()
            ->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role'],
                'lastName' => $data['lastName'],
                'phones' => $data['phones'],
                'password' => Hash::make($data['password']),
            ]);
        $user->profile()->create([
            'alternativePhones' => $data['phones']
        ]);
        return $user;
    }
}
