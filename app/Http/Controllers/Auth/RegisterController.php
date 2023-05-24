<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CustomerMail;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Traits\RedirectAuthentication;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use RedirectAuthentication;
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'lastName' => ['required', 'string', 'max:255'],
            'phones' => [
                'required',
                'min:10',
                'regex:/^1[0-9]{10}$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class, 'id')
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
            ],
            'role' => ['required', Rule::in(3, 4)],
        ]);
    }

    protected function create(array $data)
    {
        dd($data['role']);
        $user = User::query()
            ->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role'],
                'lastName' => $data['lastName'],
                'phones' => $data['phones'],
                'password' => Hash::make($data['password']),
            ]);
        if (3 === $data['role']) {
            $user->company()->create([
                'email' => $data['email'],
            ]);
            Notification::send($user, new WelcomeNotification($user));

            return $user;
        } elseif ($data['role'] = 4) {
            $user->profile()->create([
                'alternativePhones' => $data['phones'],
            ]);
            Mail::send(new CustomerMail($user));

            return $user;
        }
    }
}
