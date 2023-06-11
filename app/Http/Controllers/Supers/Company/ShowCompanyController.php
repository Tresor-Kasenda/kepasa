<?php

namespace App\Http\Controllers\Supers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowCompanyController extends Controller
{
    public function __invoke(Company $company)
    {
        return View::make('admins.pages.company.show', [
            'company' => $company->load(['user', 'events'])
        ]);
    }
}
