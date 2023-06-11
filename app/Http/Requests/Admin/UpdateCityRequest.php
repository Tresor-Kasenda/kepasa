<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'cityName' => [
                'required',
                'string',
                'max:255'
            ],
            'facts' => [
                'required',
                'string',
                'min:2'
            ],
            'overview' => [
                'required',
                'string',
                'min:2'
            ],
            'currency' => [
                'required',
                'string',
                'min:2'
            ],
            'country_code' => [
                'required',
                'string',
                'min:3'
            ],
            'language' => [
                'required',
                'string'
            ],
            'population' => [
                'required',
                'string',
                'min:2'
            ],
            'popular_city' => [
                'required',
                'string',
                'min:2'
            ],
            'mayor' => [
                'required',
                'string',
                'min:2'
            ],
            'images' => [
                'required',
                'image',
            ],
            'history' => [
                'required',
                'string'
            ],
            'promoted' => ['required'],
        ];
    }
}
