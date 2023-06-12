<?php

declare(strict_types=1);

namespace App\Http\Requests\Organiser\Company;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'companyName' => [
                'required',
                'string',
                'max:255',
                new Unique(Company::class, 'companyName'),
            ],
            'address' => [
                'required',
                'string',
            ],
            'phonesCompany' => [
                'required',
                'min:10',
                new Unique(Company::class, 'phones'),
            ],
            'emailCompany' => [
                'required',
                'email',
                new Unique(Company::class, 'email'),
            ],
            'website' => [
                'required',
                'string',
            ],
            'socialMedia' => [
                'required',
                'string',
            ],
            'country' => [
                'required',
                new Exists(Country::class, 'countryCode'),
            ],
            'cityName' => [
                'required',
            ],
        ];
    }
}
