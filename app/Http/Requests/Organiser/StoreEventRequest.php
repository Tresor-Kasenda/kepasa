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
                'date',
                'after:today'
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date'
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
}
