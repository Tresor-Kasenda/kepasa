<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class SettingSupperRepository
{
    public function update(string $key, $attributes): Model|Builder|RedirectResponse
    {
        $user = $this->getAdmin($key);
        $this->updateAdmin($user, $attributes);
        $setting = $this->getSetting($user);
        $this->updateSetting($setting, $attributes, $user);
        toast('Settings is update', 'success');

        return $setting;
    }

    public function updatePassword(string $key, $attributes): Model|Builder|null
    {
        $user = $this->getAdmin(key: $key);
        $user->update([
            'password' => Hash::make($attributes->input('password')),
        ]);
        toast('Password is update', 'success');

        return $user;
    }

    private function getAdmin(string $key): null|Builder|Model
    {
        return User::query()
            ->where('key', '=', $key)
            ->first();
    }

    private function updateAdmin($user, $attributes): void
    {
        $user->update([
            'name' => $attributes->input('username'),
            'lastName' => $attributes->input('lastname'),
            'phones' => $attributes->input('phones'),
            'email' => $attributes->input('adminEmail'),
        ]);
    }

    private function getSetting(Model|Builder|null $user): null|Builder|Model
    {
        return Setting::query()
            ->where('user_id', '=', $user->id)
            ->first();
    }

    private function updateSetting($setting, $attributes, $user): void
    {
        $setting->update([
            'name' => $attributes->input('name'),
            'email' => $attributes->input('email'),
            'copyright' => $attributes->input('copyright'),
            'user_id' => $user->id,
        ]);
    }
}
