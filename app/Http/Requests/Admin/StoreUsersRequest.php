<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

class StoreUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string', 'max:255',
            ],
            'lastName' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/(.+)@(.+)\.(.+)/i',
                new Unique(User::class, 'email'),
            ],
            'phones' => [
                'required',
                'string',
                'min:10',
                new Unique(User::class, 'phones'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'country' => [
                'required',
                'int',
                new Exists(Country::class, 'id'),
            ],
        ];
    }
}
