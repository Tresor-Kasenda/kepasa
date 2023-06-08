<?php

namespace App\Http\Controllers\Organisers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Repository\Organisers\ProfileOrganiserRepository;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    public function __construct(
        protected readonly ProfileOrganiserRepository $repository
    ) {
    }

    public function __invoke(User $user, UpdateProfileRequest $request)
    {
        $this->authorize('update', $user);

        $this->repository->updateProfile(
            $user,
            $request
        );

        return redirect()
            ->route('organiser.profile', '#profile')
            ->with('success', "Profile updated with successful");
    }
}
