<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Company_QB;

class UpdateCompanyRepository
{
    public function updateCompany(User $user, array $validated): Model|Company|Builder|_IH_Company_QB|null
    {
        $company = Company::query()
            ->where('user_id', '=', $user->id)
            ->first();

        $company->update([
            'companyName' => $validated['companyName'],
            'address' => $validated['address'],
            'phones' => $validated['phonesCompany'],
            'alternativeNumber' => $validated['phonesCompany'],
            'email' => $validated['emailCompany'],
            'website' => $validated['website'],
            'socialMedia' => $validated['socialMedia'],
            'country' => $validated['country'],
            'city' => $validated['cityName'],
            'updated_at' => now()
        ]);

        return $company;
    }
}
