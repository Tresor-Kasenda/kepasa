<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UpdateCompanyRepository
{
    public function updateCompany(User $user, array $validated): Model|Company|Builder|null
    {
        $company = Company::query()
            ->where('user_id', '=', $user->id)
            ->first();

        $company->update(
            [
            'company_name' => $validated['company_name'],
            'address' => $validated['address'],
            'phones' => $validated['phonesCompany'],
            'email' => $validated['emailCompany'],
            'website' => $validated['website'],
            'socialMedia' => $validated['social_media'],
            'country_id' => $validated['countryCompany'],
            'updated_at' => now(),
            ]
        );

        return $company;
    }
}
