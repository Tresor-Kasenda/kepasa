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

        $company->update([
            'company_name' => $validated['companyName'],
            'address' => $validated['address'],
            'phones' => $validated['phonesCompany'],
            'alternativeNumber' => $validated['phonesCompany'],
            'email' => $validated['emailCompany'],
            'website' => $validated['website'],
            'socialMedia' => $validated['socialMedia'],
            'country_id' => $validated['country'],
            'city_id' => $validated['cityName'],
            'updated_at' => now(),
        ]);

        return $company;
    }
}
