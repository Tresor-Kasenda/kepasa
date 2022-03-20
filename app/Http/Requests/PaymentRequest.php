<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ['required', Rule::exists('events', 'title')],
            "lastNameOrganiser" => ['required', Rule::exists('users', 'lastName')],
            "name" => ['required', Rule::exists('categories', 'name')],
            "prices" => ['required', Rule::exists('events', 'prices')],
            "ticketNumber" => ['required', 'numeric']
        ];
    }
}
