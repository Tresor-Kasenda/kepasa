<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Enums\RoleEnum;
use App\Mail\CreatedAdminEmail;
use App\Models\User;
use App\Repository\Contracts\AdminRepositoryInterface;
use App\Repository\Contracts\ReadRepositoryInterface;
use App\Repository\Contracts\WriteRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminSupperRepository implements AdminRepositoryInterface, WriteRepositoryInterface, ReadRepositoryInterface
{
    public function getContents(): array|Collection
    {
        return User::query()
            ->whereIn('role_id', [RoleEnum::ADMIN, RoleEnum::ORGANISER, RoleEnum::USERS])
            ->orderByDesc('created_at')
            ->get();
    }

    public function getElementByKey(string $key): Model|Builder|null
    {
        return $this->getAdmin($key);
    }

    public function created($attributes): Model|Builder|RedirectResponse
    {
        $admin = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->orWhere('phones', '=', $attributes->input('phones'))
            ->first();

        if (null !== $admin) {
            toast('Cet email est deja utiliser', 'error');

            return back();
        }

        $user = User::query()
            ->create([
                'name' => $attributes->input('name'),
                'lastName' => $attributes->input('lastName'),
                'email' => $attributes->input('email'),
                'phones' => $attributes->input('phones'),
                'password' => Hash::make($attributes->input('password')),
                'role_id' => 2,
            ]);
        Mail::send(new CreatedAdminEmail($user));
        toast('Un nouveau admin a ete cree', 'success');

        return $user;
    }

    public function updated($attributes, $key): Model|Builder|null
    {
        $admin = $this->getAdmin(key: $key);
        $admin->update([
            'name' => $attributes->input('name'),
            'lastName' => $attributes->input('lastName'),
            'email' => $attributes->input('email'),
            'phones' => $attributes->input('phones'),
            'password' => Hash::make($attributes->input('password')),
        ]);
        toast("L'admin a ete mise a jours", 'success');

        return $admin;
    }

    public function delete($key): Model|Builder|null
    {
        $admin = $this->getAdmin(key: $key);
        $admin->delete();
        toast('un administrateur a ete supprimer', 'success');

        return $admin;
    }

    private function getAdmin(string $key): null|Builder|Model
    {
        return User::query()
            ->where('key', '=', $key)
            ->first();
    }
}
