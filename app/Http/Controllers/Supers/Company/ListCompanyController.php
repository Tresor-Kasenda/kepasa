<?php

declare(strict_types=1);

namespace App\Http\Controllers\Supers\Company;

use App\Http\Controllers\Controller;
use App\Repository\Suppers\Company\ListCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ListCompanyController extends Controller
{
    public function __invoke(Request $request, ListCompanyRepository $repository)
    {
        return View::make(
            'admins.pages.company.list-company',
            [
                'companies' => $repository->company($request),
            ]
        );
    }
}
