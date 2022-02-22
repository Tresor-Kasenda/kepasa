<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public static function uploadFiles(Request $request): string
    {
        return $request->file('image')
            ->storePublicly('/', ['disk' => 'public']);
    }

    public static function uploadProfile(Request $request): string
    {
        return $request->file('images')
            ->storePublicly('/', ['disk' => 'public']);
    }

    public function removePicture(Model $model)
    {
        Storage::disk('public')
            ->delete($model->image);
    }

    public function removeProfile(Model $model)
    {
        Storage::disk('public')
            ->delete($model->images);
    }
}
