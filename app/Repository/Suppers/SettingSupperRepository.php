<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Setting;
use App\Models\User;

class SettingSupperRepository
{
    public function update(User $user, $attributes)
    {
        return $this->updateSetting($attributes, $user);
    }

    private function updateSetting($attributes, $user)
    {
        $setting = Setting::query()
            ->where('user_id', '=', $user->id)
            ->first();
        if ($setting) {
            $settings = $setting->update([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'copyright' => $attributes['copyright'],
            ]);

            toast('Settings is update', 'success');

            return $settings;
        }
        $set = Setting::query()
            ->create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'copyright' => $attributes['copyright'],
                'user_id' => $user->id
            ]);

        toast('Settings is created with successful', 'success');

        return $set;
    }
}
