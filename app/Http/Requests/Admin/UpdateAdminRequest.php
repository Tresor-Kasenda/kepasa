<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

class UpdateAdminRequest extends FormRequest
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
                'string',
                'max:255'
            ],
            'phones' => [
                'required',
                'numeric',
                new Unique(User::class, 'phones')
            ],
            'country' => [
                'required',
                new Exists(Country::class, 'id')
            ],
            'lastName' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
            ]
        ];
    }
}
