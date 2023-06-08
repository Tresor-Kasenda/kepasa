<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->role_id === RoleEnum::ORGANISER;
    }

    public function update(User $user, Company $company): bool
    {
        return $user->id === $company->user_id;
    }

    public function delete(User $user, Company $company): bool
    {
        return  $user->id === $company->user_id;
    }
}
