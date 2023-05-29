<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureComponents();
        Blade::component('layouts.app', 'app-layout');
        Blade::component('layouts.organiser', 'organiser-layout');

    }


    protected function configureComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (): void {
            $this->registerComponent('icon');
            $this->registerComponent('container');
            $this->registerComponent('nav-link');
        });
    }

    protected function registerComponent(string $component): void
    {
        Blade::component('admins.partials.'.$component, 'vex-'.$component);
    }
}
