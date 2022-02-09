<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ProfileOrganiserRepository
{
    public function getCountries(): Collection|array
    {
        return Country::query()
            ->get();
    }

    public function getCompany($attributes): Model|Builder|null
    {
        return Company::query()
            ->where('companyName', '=', $attributes->input('companyName'))
            ->orWhere('website', '=', $attributes->input('companyWebsite'))
            ->first();
    }

    public function updateCompany($attributes): Model|Builder
    {
        $company = Company::query()
            ->where('user_id', '=', $attributes->user()->id)
            ->first();
        $this->updateUserAuthenticate($attributes);
        $this->companyUpdate($company, $attributes);
        return $company;
    }


    public function updatePassword($attributes): Model|Builder
    {
        $user = User::query()
            ->where('key', '=', $attributes->user()->key)
            ->firstOrFail();
        $user->update([
            'password' => Hash::make($attributes->input('password'))
        ]);
        return $user;
    }

    private function updateUserAuthenticate($attributes)
    {
        $user = User::query()
            ->where('id', '=', $attributes->user()->id)
            ->first();
        $user->update([
            'name' => $attributes->input('name'),
            'lastName' => $attributes->input('lastName'),
            'phones' => $attributes->input('phones'),
        ]);
    }

    private function companyUpdate($company, $attributes): void
    {
        $company->update([
            'companyName' => $attributes->input('companyName'),
            'address' => $attributes->input('address'),
            'phones' => $attributes->input('phones'),
            'alternativeNumber' => $attributes->input('alternativeNumber'),
            'email' => $attributes->input('companyEmail'),
            'website' => $attributes->input('companyWebsite'),
            'country' => $attributes->input('country'),
            'city' => $attributes->input('city'),
        ]);
    }
}
