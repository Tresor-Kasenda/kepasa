<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatusUserRequest;
use App\Models\User;

class UpdateStatusUserController extends Controller
{
    public function __invoke(StatusUserRequest $request)
    {
        $user = User::query()
            ->where('id', '=', $request->input('users'))
            ->first();

        $this->authorize('update', $user);

        $user->update([
            'status' => $request->input('status')
        ]);
        return response()->json([
            'success' => 'Uitlisateur activez avec success',
            'room' => $user,
        ]);
    }
}
