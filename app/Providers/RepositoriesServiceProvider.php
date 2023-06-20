<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\Contracts\OnlineRepositoryInterface;
use App\Repository\Organisers\EnableXRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(
            OnlineRepositoryInterface::class,
            EnableXRepository::class
        );
    }
}
