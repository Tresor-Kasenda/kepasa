<?php

declare(strict_types=1);

namespace App\Http\Requests\Organiser;

use App\Enums\FeeOptionEnum;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class EventUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:4',
            ],
            'subTitle' => [
                'required',
                'min:4',
            ],
            'category' => [
                'required',
                new Exists(Category::class, 'id'),
            ],
            'date' => [
                'required',
                'date',
                'after:tomorrow',
            ],
            'startTime' => [
                'required',
                'date_format:H:i',
                'required_with:endTime',
            ],
            'endTime' => [
                'required',
                'date_format:H:i',
                'required_with:startTime',
                'after:startTime',
            ],
            'address' => [
                'required',
                'min:5',
            ],
            'ticketNumber' => [
                'required',
                'min:1',
            ],
            'prices' => [
                'required',
                'min:1',
            ],
            'feeOption' => [
                'required',
                Rule::in(FeeOptionEnum::$types),
            ],
            'country' => [
                'required',
                new Exists(Country::class, 'countryCode'),
            ],
            'cityName' => [
                'required',
                new Exists(City::class, 'cityName'),
            ],
            'description' => [
                'nullable',
                'min:10',
            ],
        ];
    }
}
