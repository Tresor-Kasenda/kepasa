<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class UpdateProfileRequest extends FormRequest
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
            'lastName' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
            ],
            'phones' => [
                'required',
                'string',
                'min:10'
            ],
            'country' => [
                'required',
                'integer',
                new Exists(Country::class, 'id')
            ],
            'city' => [
                'required'
            ]
        ];
    }
}
