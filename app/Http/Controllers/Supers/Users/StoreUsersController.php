<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Repository\Suppers\Users\StoreUsersRepository;

class StoreUsersController extends Controller
{
    public function __invoke(StoreUsersRequest $request, StoreUsersRepository $repository)
    {
        $repository->created($request->validated());

        toast('Un nouveau admin a ete cree', 'success');

        return redirect()->route('supper.users-list');
    }
}
