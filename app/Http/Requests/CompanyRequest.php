<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4'],
            'lastName' => ['required', 'string', 'min:4'],
            'phones' => ['required', 'string', 'min:10'],
            'alternativeNumber' => ['required', 'string', 'min:10'],
            'companyName' => ['required', 'string', 'min:4'],
            'companyEmail' => ['required', 'string', 'email'],
            'companyWebsite' => ['required', 'string', 'min:4'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string', 'min:4'],
            'address' => ['required', 'string'],
        ];
    }
}
