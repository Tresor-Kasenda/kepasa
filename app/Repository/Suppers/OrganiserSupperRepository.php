<?php
declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class OrganiserSupperRepository
{
    public function getContents(): Collection|array
    {
        return User::query()
            ->orderByDesc('created_at')
            ->get();
    }
}
