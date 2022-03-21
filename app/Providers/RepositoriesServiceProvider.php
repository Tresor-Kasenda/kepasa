<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repository\Contracts\AdminRepositoryInterface;
use App\Repository\Contracts\JoinRoomRepositoryInterface;
use App\Repository\Contracts\OnlineRepositoryInterface;
use App\Repository\Contracts\PaymentRepositoryInterface;
use App\Repository\Contracts\ReadRepositoryInterface;
use App\Repository\Contracts\WriteRepositoryInterface;
use App\Repository\Organisers\EnableXRepository;
use App\Repository\Organisers\OnlineEventRepository;
use App\Repository\Organisers\PaypalRepository;
use App\Repository\Suppers\AdminSupperRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register(){}

    public function boot()
    {
        $this->app->bind(
            OnlineRepositoryInterface::class,
            EnableXRepository::class
        );

        $this->app->bind(
            JoinRoomRepositoryInterface::class,
            OnlineEventRepository::class
        );
    }
}
