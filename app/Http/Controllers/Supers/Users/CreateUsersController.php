<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CreateUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        return View::make('admins.pages.users.create');
    }
}
