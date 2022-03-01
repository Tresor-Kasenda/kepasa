<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShareRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ['required', 'string', 'max:255'],
            "First_Name" => ['required', 'string', 'max:255'],
            "middleName" => ['required', 'string', 'max:255'],
            "lastName" => ['required', 'string', 'max:255'],
            "contact" => ['required', 'string', 'min:10'],
            "secondContact" => ['required', 'string', 'max:255'],
            "email" => ['required', 'email'],
            "position" => ['required', 'string', 'max:255'],
            "department" => ['required', 'string', 'max:255'],
            "city" => ['required', 'string', 'max:255'],
            "province" => ['required', 'string', 'max:255'],
            "country" => ['required', 'string', 'max:255'],
            "message" => ['required', 'string'],
        ];
    }
}
