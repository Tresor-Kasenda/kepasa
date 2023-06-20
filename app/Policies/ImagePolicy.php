<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Images;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ImagePolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Images $image): Response|bool
    {
    }
}
