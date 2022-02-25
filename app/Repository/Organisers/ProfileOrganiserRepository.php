<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use App\Services\ImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ProfileOrganiserRepository
{
    use ImageUpload;

    public function getCountries(): Collection|array
    {
        return Country::query()
            ->get();
    }

    public function getCompany($attributes): Model|Builder|null
    {
        return Company::query()
            ->where('companyName', '=', $attributes->input('companyName'))
            ->where('user_id', '=', auth()->id())
            ->first();
    }

    public function updateCompany($attributes): Model|Builder
    {
        $company = $this->getCompanyByUser(attributes: $attributes);
        $this->updateUserAuthenticate($attributes);
        $this->companyUpdate($company, $attributes);
        return $company;
    }

    public function updatePassword(string $key, $attributes): Model|Builder
    {
        $user = User::query()
            ->where('key', '=', $key)
            ->firstOrFail();
        $user->update([
            'password' => Hash::make($attributes->input('password'))
        ]);
        return $user;
    }

    public function uploadImages($attributes): Model|Builder|null
    {
        $organiser = $this->getCompanyByUser($attributes);
        $this->removeProfile($organiser);
        $organiser->update([
            'images' => self::uploadProfile($attributes)
        ]);
        return $organiser;
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

    private function getCompanyByUser($attributes): null|Builder|Model
    {
        return Company::query()
            ->where('user_id', '=', auth()->id())
            ->first();
    }
}
