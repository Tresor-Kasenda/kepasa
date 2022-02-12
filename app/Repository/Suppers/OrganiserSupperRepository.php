<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Company;
use Illuminate\Support\Collection;

class OrganiserSupperRepository
{
    public function getContents(): array|Collection
    {
        return Company::query()
            ->orderByDesc('created_at')
            ->get();
    }
}
