<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city' => ['required', 'string', Rule::exists('cities', 'cityName')],
            'country' => ['required', 'string', Rule::exists('countries', 'countryCode')],
        ];
    }
}
