<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class AdminSupperRepository
{
    public function getContents(): array|Collection
    {
        return User::query()
            ->where('role_id', '=', 2)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getAdminByKey(string $key): Model|Builder|null
    {
        return $this->getAdmin($key);
    }

    public function create($attributes): Model|Builder|RedirectResponse
    {
        $admin = User::query()
            ->where('email', '=', $attributes->input('email'))
            ->orWhere('phones', '=', $attributes->input('phones'))
            ->first();

        if ($admin !== null){
            toast("Cet email est deja utiliser", 'error');
            return back();
        }

        $user = User::query()
            ->create([
                "name" => $attributes->input('name'),
                "lastName" => $attributes->input('lastName'),
                "email" => $attributes->input('email'),
                "phones" => $attributes->input('phones'),
                "password" => Hash::make($attributes->input('password')),
                'role_id' => 2
            ]);
        toast("Un nouveau admin a ete cree", 'success');
        return $user;
    }

    public function updateAdmin($attributes, $key): Model|Builder|null
    {
        $admin = $this->getAdmin(key: $key);
        $admin->update([
            "name" => $attributes->input('name'),
            "lastName" => $attributes->input('lastName'),
            "email" => $attributes->input('email'),
            "phones" => $attributes->input('phones'),
            "password" => Hash::make($attributes->input('password')),
        ]);
        toast("L'admin a ete mise a jours", 'success');
        return $admin;
    }

    public function delete($key): Model|Builder|null
    {
        $admin = $this->getAdmin(key: $key);
        $admin->delete();
        toast("un administrateur a ete supprimer", 'success');
        return $admin;
    }

    private function getAdmin(string $key): null|Builder|Model
    {
        return User::query()
            ->where('key', '=', $key)
            ->first();
    }
}
