<?php

declare(strict_types=1);

namespace App\Repository\Suppers;

use App\Models\Company;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrganiserSupperRepository
{
    use ImageUpload;

    public function getContents(): array|Collection
    {
        return Company::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function getCompanyByKey(string $key): Model|Builder|null
    {
        $company = $this->getCompany($key);

        return $company->load(['user', 'events']);
    }

    public function delete(string $key): Model|Builder|null
    {
        $company = $company = $this->getCompany($key);
        $user = User::query()
            ->where('id', '=', $company->user_id)
            ->first();
        $this->removeProfile($company);
        $user->delete();
        toast('Organiser supprimer du systeme', 'success');

        return $user;
    }

    private function getCompany(string $key): null|Builder|Model
    {
        return Company::query()
            ->where('key', '=', $key)
            ->first();
    }
}
