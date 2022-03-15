<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repository\OrganiserRepositoryInterface;
use App\Repository\Organisers\EnableXRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            OrganiserRepositoryInterface::class,
            EnableXRepository::class
        );
    }
}
