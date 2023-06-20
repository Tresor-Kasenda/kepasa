<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public static function uploadFile($request): string
    {
        return $request->file('image')
            ->storePublicly('/', ['disk' => 'public']);
    }

    public static function uploadProfile($request): string
    {
        return $request->file('avatar')
            ->storePublicly('/', ['disk' => 'public']);
    }

    public function removePicture(Model $model): void
    {
        Storage::disk('public')
            ->delete($model->image);
    }

    public function removeProfile(Model $model): void
    {
        Storage::disk('public')
            ->delete($model->images);
    }
}
