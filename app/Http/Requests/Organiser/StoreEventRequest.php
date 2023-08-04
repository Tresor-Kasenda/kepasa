<?php

declare(strict_types=1);

namespace App\Http\Requests\Organiser;

use App\Enums\FeeOptionEnum;
use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\City;
use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return RoleEnum::ROLE_ORGANISER === auth()->user()->role_id;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:4',
                new Unique(Event::class, 'title'),
            ],
            'category' => [
                'required',
                'int',
                new Exists(Category::class, 'id'),
            ],
            'event_date' => [
                'required',
                'date',
                'after:today',
            ],
            'start_date' => [
                'required',
                'date_format:H:i',
            ],
            'end_date' => [
                'required',
                'date_format:H:i',
                'after:start_date',
            ],
            'address' => [
                'required',
                'min:5',
            ],
            'ticket_number' => [
                'required',
                'min:1',
            ],
            'prices' => [
                'required',
                'min:1',
            ],
            'fee_option' => [
                'required',
                Rule::in(FeeOptionEnum::$types),
            ],
            'city' => [
                'required',
                new Exists(City::class, 'id'),
            ],
            'description' => [
                'nullable',
                'min:10',
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 4 characters',
            'title.unique' => 'Title must be unique',
            'category.required' => 'Category is required',
            'category.int' => 'Category must be integer',
            'category.exists' => 'Category must be exists',
            'event_date.required' => 'Event date is required',
            'event_date.date' => 'Event date must be date',
            'event_date.after' => 'Event date must be after today',
            'start_date.required' => 'Start date is required',
            'start_date.date' => 'Start date must be date',
            'start_date.date_format' => 'Start date must be in format H:i',
            'end_date.required' => 'End date is required',
            'end_date.date' => 'End date must be date',
            'end_date.date_format' => 'End date must be in format H:i',
            'end_date.after' => 'End date must be after start date',
            'address.required' => 'Address is required',
            'address.min' => 'Address must be at least 5 characters',
            'ticket_number.required' => 'Ticket number is required',
            'ticket_number.min' => 'Ticket number must be at least 1',
            'prices.required' => 'Prices is required',
            'prices.min' => 'Prices must be at least 1',
            'fee_option.required' => 'Fee option is required',
            'fee_option.in' => 'Fee option must be in ' . implode(', ', FeeOptionEnum::$types),
            'city.required' => 'City is required',
            'city.exists' => 'City must be exists',
            'description.min' => 'Description must be at least 10 characters'
        ];
    }
}
