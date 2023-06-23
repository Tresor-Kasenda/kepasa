<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\Profile\UploadImageRequest;
use App\Repository\Organisers\Company\UploadImageRepository;

class UploadProfileController extends Controller
{
    public function __construct(
        protected readonly UploadImageRepository $repository
    ) {
    }

    public function __invoke(UploadImageRequest $request)
    {
        $this->repository->uploadImages($request);
        return response()->json(
            [
                'messages' => 'Photo de profile uploader',
                'status' => 'success',
            ],
            200
        );
    }
}
