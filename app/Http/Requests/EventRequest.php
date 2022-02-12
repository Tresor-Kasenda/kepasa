<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\FeeOptionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "title" => ['required', 'min:4'],
            "subTitle" => ['required', 'min:4'],
            "category_id" => ['required', Rule::exists('categories', 'id')],
            "date" => ['required', 'date', 'date_format:Y:m:d', 'after:tomorrow'],
            "startTime" => ['required', 'date', 'date_format:H:i'],
            "endTime" => ['required', 'date', 'date_format:H:i', 'after_or_equal:startTime'],
            "address" => ['required', 'min:5'],
            "ticketNumber" => ['required', 'min:1'],
            "prices" => ['required', 'min:1'],
            "feeOption" => ['required', Rule::in(FeeOptionEnum::$types)],
            "country" => ['required', Rule::exists('countries', 'countryCode')],
            "cityName" => ['required'],
            "description" => ['nullable', 'min:10'],
            "image" => ['required'],
            "image.*" => ['mimes:jpeg,jpg,png,gif,csv,txt,pdf', 'max:2048']
        ];
    }
}
