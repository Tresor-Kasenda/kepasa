<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => ['required', 'string', 'min:4'],
            "lastName" => ['required', 'string', 'min:4'],
            "email" => ['required', 'string', 'email'],
            "phones" => ['required', 'string', 'min:10'],
            "alternativePhones" => ['required', 'string', 'min:10'],
            "city" => ['required', 'string'],
            "country" => ['required'],
            "images" => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000']
        ];
    }
}
