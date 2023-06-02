<?php

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class UpdateUsersRequest extends FormRequest
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
                'string', 'max:255'
            ],
            'lastName' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/(.+)@(.+)\.(.+)/i',
            ],
            'phones' => [
                'required',
                'string',
                'min:10',
            ],
            'country' => [
                'required',
                'int',
                new Exists(Country::class, 'id')
            ],
            'images' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png'
            ]
        ];
    }
}
