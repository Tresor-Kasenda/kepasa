<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class StatusUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'users' => [
                'required',
                'int',
                new Exists(User::class, 'id'),
            ],
            'status' => [
                'required',
                'bool',
            ],
        ];
    }
}
