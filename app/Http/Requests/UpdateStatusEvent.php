<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStatusEvent extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => ['required', Rule::in(StatusEnum::$status)],
            'key' => ['required', Rule::exists('events', 'id')],
        ];
    }
}
