<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4', 'string'],
            'email' => ['required', 'email'],
            'copyright' => ['required', 'string', 'min:4'],
            'username' => ['required', 'string', 'min:4'],
        ];
    }
}
