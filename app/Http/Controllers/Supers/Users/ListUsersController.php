<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\Users\ListUsersRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;

class ListUsersController extends Controller
{
    public function __invoke(ListUsersRepository $repository): Renderable
    {
        return View::make('admins.pages.users.index', [
            'users' => $repository->users(),
        ]);
    }
}
