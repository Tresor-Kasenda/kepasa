<?php

declare(strict_types=1);

namespace App\Repository\Suppers\Company;

use App\Models\Company;
use Illuminate\Http\Request;

class ListCompanyRepository
{
    public function company(Request $request)
    {
        return Company::query()
            ->with(['user'])
            ->search(
                search: $request->input('search')
            )
            ->get();
    }
}
