<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnableXTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key' => ['required', Rule::exists('events', 'id')],
            'name' => ['required', Rule::exists('users', 'key')],
            'reference' => ['required', Rule::exists('online_events', 'reference')],
        ];
    }
}
