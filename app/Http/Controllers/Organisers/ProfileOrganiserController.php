<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repository\Organisers\ProfileOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ProfileOrganiserController extends Controller
{
    public function __construct(public ProfileOrganiserRepository $repository)
    {
    }

    public function update(string $key, UpdateProfileRequest $attributes): RedirectResponse
    {
        $this->repository->updatePassword(key: $key, attributes: $attributes);

        return back()->with('success', 'Password changed successfully');
    }

    public function updateCompany(CompanyRequest $attributes): RedirectResponse
    {
        $this->repository->updateCompany($attributes);

        return back()->with('success', 'An update has been made for the company');
    }

    public function uploadPicture(ProfileImageRequest $attributes): JsonResponse
    {
        $images = $this->repository->uploadImages(attributes: $attributes);

        return response()->json([
            'messages' => 'Photo de profile uploader',
            'status' => 'success',
            'data' => $images,
        ], 200);
    }
}
