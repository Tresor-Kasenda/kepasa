<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Setting_QB;

class SettingSupperRepository
{
    public function update(User $user, $attributes): Model|Builder|Setting|bool|int|_IH_Setting_QB
    {
        return $this->updateSetting($attributes, $user);
    }

    private function updateSetting($attributes, $user)
    {
        $setting = Setting::query()
            ->where('user_id', '=', $user->id)
            ->first();
        if ($setting) {
            $settings = $setting->update(
                [
                    'name' => $attributes['name'],
                    'email' => $attributes['email'],
                    'copyright' => $attributes['copyright'],
                ]
            );

            toast('Settings is update', 'success');

            return $settings;
        }
        $set = Setting::query()
            ->create(
                [
                    'name' => $attributes['name'],
                    'email' => $attributes['email'],
                    'copyright' => $attributes['copyright'],
                    'user_id' => $user->id,
                ]
            );

        toast('Settings is created with successful', 'success');

        return $set;
    }
}
