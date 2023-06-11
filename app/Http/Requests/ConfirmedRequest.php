<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfirmedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', Rule::exists('users', 'email')],
            'numberOfTickets' => ['required', Rule::exists('events', 'ticketNumber')],
            'address' => ['required', Rule::exists('events', 'address')],
            'prices' => ['required', Rule::exists('events', 'prices')],
            'endTime' => ['required', Rule::exists('events', 'endTime')],
            'startTime' => ['required', Rule::exists('events', 'startTime')],
            'date' => ['required', Rule::exists('events', 'date')],
            'subTitle' => ['required', Rule::exists('events', 'subTitle')],
            'title' => ['required', Rule::exists('events', 'title')],
            'name' => ['required', Rule::exists('categories', 'name')],
            'nameOrganiser' => ['required', Rule::exists('users', 'name')],
            'lastNameOrganiser' => ['required', Rule::exists('users', 'lastName')],
        ];
    }
}
