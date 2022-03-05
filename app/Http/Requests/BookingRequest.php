<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ['required', Rule::exists('events', 'title')],
            "prices" => ['required', Rule::exists('events', 'prices')],
            "startTime" => ['required', Rule::exists('events', 'startTime')],
            "date" => ['required', Rule::exists('events', 'date')],
            "city" => ['required', Rule::exists('events', 'city')],
            "country" => ['required', Rule::exists('events', 'country')],
            "tickets" => ['required', 'min:1', 'integer'],
            "cardType" => "creditCard",
        ];
    }
}
