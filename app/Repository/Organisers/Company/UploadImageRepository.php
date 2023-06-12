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
        $organiser = $this->getCompanyByUser();
        $user = auth()->user();
        dd($user, $request);
        $this->removeProfile($organiser);
        $organiser->update([
            'images' => self::uploadProfile($request),
        ]);
        $this->removeProfile($user);
        auth()->user()->update([
            'images' => self::uploadProfile($request),
        ]);

        return $organiser;
    }

    private function getCompanyByUser(): null|Builder|Model
    {
        return Company::query()
            ->where('user_id', '=', auth()->id())
            ->first();
    }
}
