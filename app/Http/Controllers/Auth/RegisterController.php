<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
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
            'phones' => [
                'required',
                'min:10',
                Rule::unique(User::class, 'phones'),
            ],
            'emailUser' => [
                'required',
                'email',
                Rule::unique(User::class, 'email'),
            ],
            'role' => [
                'required',
                Rule::in([2, 3])
            ],
            'city' => [
                'required',
                new Exists(City::class, 'city_name')
            ],
            'passwordAuth' => [
                'required',
                'string',
                Password::min(6)
            ],
        ]);
    }

    protected function create(array $data)
    {
        $city = City::query()
            ->whereId($data['city'])
            ->first();
        if ($city->doesntExist()) {
            throw ValidationException::withMessages([
                "Country doesn't exist for moment you can contact administrator"
            ])
                ->redirectTo('/login');
        }

        $user = User::query()
            ->create([
                'name' => $data['name'],
                'phones' => $data['phones'],
                'email' => $data['emailUser'],
                'role_id' => $data['role'],
                'country_id' => $city->id,
                'password' => Hash::make($data['passwordAuth']),
            ]);

        if (RoleEnum::ROLE_ORGANISER->value === (int)$data['role']) {
            Company::query()->create(['user_id' => $user->id]);
            Notification::send([$user, User::whereRoleId(RoleEnum::ROLE_SUPER)->get()], new WelcomeNotification($user));
        } else {
            Notification::send($user, new UserWelcomeNotification($user));
        }
        return $user;
    }
}
