<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class EditUserController extends Controller
{
    public function __invoke(User $user)
    {
        return view('admins.pages.users.edit', [
            'user' => $user
        ]);
    }
}
