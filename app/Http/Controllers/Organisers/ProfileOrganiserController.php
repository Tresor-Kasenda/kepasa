<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\ProfileOrganiserRequest;
use App\Repository\Organisers\ProfileOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileOrganiserController extends Controller
{
    public function __construct(public ProfileOrganiserRepository $repository){}

    public function index(): Renderable
    {
        return view('organisers.pages.profiles.index', [
            'countries' => $this->repository->getCountries()
        ]);
    }

    public function store(ProfileOrganiserRequest $attributes): JsonResponse
    {
        $this->repository->updatePassword($attributes);
        return response()->json([
            'messages' => "Le mot de passe a ete  mise a jour"
        ]);
    }

    public function updateCompany(CompanyRequest $attributes): JsonResponse
    {
        $company = $this->repository->getCompany($attributes);
        if ($company == null){
            $this->repository->updateCompany($attributes);
            return response()->json([
                'message' => "La mise a ete faite avec success",
                'status' => 'success'
            ], 200);
        }
        return response()->json([
            'messages' => "Company ou lien existe deja",
            'status' => 'error'
        ]);
    }

    public function uploadPicture(ProfileImageRequest $attributes)
    {
        $this->repository->uploadImages(attributes:  $attributes);
    }
}
