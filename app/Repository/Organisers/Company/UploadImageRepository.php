<?php

declare(strict_types=1);

namespace App\Repository\Organisers\Company;

use App\Http\Requests\Organiser\Profile\UploadImageRequest;
use App\Models\Company;
use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UploadImageRepository
{
    use ImageUpload;
    public function uploadImages(UploadImageRequest $request): Model|Builder|null
    {
        $company = Company::whereUserId(auth()->id())->first();

        if ($company->exists()) {
            $company->images()->create(
                [
                'path' => self::uploadProfile($request)
                ]
            );
        }

        $images = auth()->user()->images()->create(
            [
            'path' => self::uploadProfile($request)
            ]
        );

        auth()->user()->update(
            [
            'feature_image_id' => $images->id
            ]
        );

        return  $images;
    }
}
