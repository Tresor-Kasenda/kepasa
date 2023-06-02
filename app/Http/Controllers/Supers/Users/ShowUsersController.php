<?php

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowUsersController extends Controller
{
    public function __invoke(User $user)
    {
        return View::make('admins.pages.users.show', [
            'user' => $user->load(['payment', 'company', 'role', 'country'])
        ]);
    }
}
