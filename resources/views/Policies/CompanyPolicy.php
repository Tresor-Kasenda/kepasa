<?php

declare(strict_types=1);

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
        return RoleEnum::ORGANISER === $user->role_id;
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
