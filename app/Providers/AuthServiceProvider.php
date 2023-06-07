<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\City;
use App\Models\Company;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\CityPolicy;
use App\Policies\CompanyPolicy;
use App\Policies\UpdateProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,
        City::class => CityPolicy::class,
        User::class => UpdateProfilePolicy::class,
        Company::class => CompanyPolicy::class
    ];

    public function boot(): void
    {
        $this->registerPolicies();


    }
}
