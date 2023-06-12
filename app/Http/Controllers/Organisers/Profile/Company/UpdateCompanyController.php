<?php

declare(strict_types=1);

namespace App\Http\Controllers\Organisers\Profile\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\Company\UpdateCompanyRequest;
use App\Models\User;
use App\Repository\Organisers\Company\UpdateCompanyRepository;

class UpdateCompanyController extends Controller
{
    public function __construct(
        protected readonly UpdateCompanyRepository $repository
    ) {
    }

    public function __invoke(User $user, UpdateCompanyRequest $request)
    {
        $this->authorize('update', $user);

        $this->repository->updateCompany(
            $user,
            $request->validated()
        );

        return redirect()
            ->route('organiser.profile', '#company')
            ->with('success', 'Company updated with successfull');
    }
}
