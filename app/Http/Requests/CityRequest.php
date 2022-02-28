<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CityPromotedEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            "cityName" => ['required', 'string', Rule::exists('cities', 'cityName')],
            "facts" => ['required', 'string', 'min:2'],
            "overview" => ['required', 'string', 'min:2'],
            "currency" => ['required', 'string', 'min:2'],
            "languages" => ['required', 'string', 'min:2'],
            "population" => ['required', 'string', 'min:2'],
            "popularCity" => ['required', 'string', 'min:2'],
            "mayor" => ['required', 'string', 'min:2'],
            "promoted" => ['required', Rule::in(CityPromotedEnum::$cities)],
            "history" => ['required', 'string'],
        ];
    }
}
