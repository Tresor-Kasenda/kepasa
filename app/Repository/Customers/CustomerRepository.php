<?php

declare(strict_types=1);

namespace App\Repository\Customers;

use App\Models\Country;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository
{
    use ImageUpload;

    public function getCountries(): Collection|array
    {
        return Country::query()
            ->get();
    }

    public function updateCustomer($attributes, string $key): Model|Builder|null
    {
        $user = User::query()
            ->where('key', '=', $key)
            ->first();
        $this->updateUser($user, $attributes);
        $this->UpdateProfile($user, $attributes);

        return $user;
    }

    private function updateUser($user, $attributes): void
    {
        $user->update(
            [
                'name' => $attributes->input('name'),
                'lastName' => $attributes->input('lastName'),
                'phones' => $attributes->input('phones'),
                'email' => $attributes->input('email'),
            ]
        );
    }

    private function UpdateProfile($user, $attributes): void
    {
        $user->profile->update(
            [
                'phones' => $attributes->input('phones'),
                'lastName' => $attributes->input('lastName'),
                'alternativePhones' => $attributes->input('alternativePhones'),
                'city' => $attributes->input('city'),
                'country' => $attributes->input('country'),
                'image' => self::uploadFile($attributes),
            ]
        );
    }
}
