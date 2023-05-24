<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\FeeOptionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:4'],
            'subTitle' => ['required', 'min:4'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'date' => ['required', 'date', 'after:tomorrow'],
            'startTime' => ['required', 'date_format:H:i', 'required_with:endTime'],
            'endTime' => ['required', 'date_format:H:i', 'required_with:startTime', 'after:startTime'],
            'address' => ['required', 'min:5'],
            'ticketNumber' => ['required', 'min:1'],
            'prices' => ['required', 'min:1'],
            'feeOption' => ['required', Rule::in(FeeOptionEnum::$types)],
            'country' => ['required', Rule::exists('countries', 'countryCode')],
            'cityName' => ['required', Rule::exists('cities', 'cityName')],
            'description' => ['nullable', 'min:10'],
        ];
    }
}
