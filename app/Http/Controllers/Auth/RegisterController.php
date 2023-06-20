<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use App\Notifications\UserWelcomeNotification;
use App\Notifications\WelcomeNotification;
use App\Traits\RedirectAuthentication;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255'
            ],
            'phones' => [
                'required',
                'min:10',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique(User::class, 'id'),
            ],
            'role' => [
                'required',
                Rule::in([2,3])
            ],
            'country' => [
                'required',
                new Exists(Country::class, 'id')
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(6)->mixedCase()
            ],
        ]);
    }

    protected function create(array $data)
    {
        $country = Country::query()
            ->whereId($data['country'])
            ->first();
        if ($country->doesntExist()) {
            throw ValidationException::withMessages([
                "Country doesn't exist for moment you can contact administrator"
            ])
                ->redirectTo('/login');
        }

        $user = User::query()
            ->create([
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'phones' => $data['phones'],
                'email' => $data['email'],
                'role_id' => $data['role'],
                'country_id' => $country->id,
                'password' => Hash::make($data['password']),
            ]);

        if (2 === (int) $data['role']) {
            Company::query()->create(['user_id' => $user->id]);
            Notification::send([$user, User::whereRoleId(RoleEnum::ROLE_SUPER)->get()], new WelcomeNotification($user));
        } else {
            Notification::send($user, new UserWelcomeNotification($user));
        }
        return $user;
    }
}
