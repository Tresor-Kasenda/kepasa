<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Users;

use App\Enums\UserStatus;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Http\RedirectResponse;

class DeleteUserRepository
{
    use ImageUpload;
    public function delete(User $user): User|RedirectResponse
    {
        if (UserStatus::STATUS_ACTIVE === $user->status) {
            return back()->with('danger', 'You cannot delete activated users');
        }
        $this->removeProfile($user);
        $user->delete();

        return $user;
    }
}
