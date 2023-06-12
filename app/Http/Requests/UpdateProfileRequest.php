<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

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
                'max:255',
            ],
            'lastName' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                (new Unique(User::class, 'email'))
                    ->ignore($this->user()->id),
            ],
            'phones' => [
                'required',
                'string',
                'min:10',
                (new Unique(User::class, 'phones'))
                    ->ignore($this->user()->id),
            ],
            'country' => [
                'required',
                'integer',
                new Exists(Country::class, 'id'),
            ],
            'city' => [
                'required',
            ],
        ];
    }
}
