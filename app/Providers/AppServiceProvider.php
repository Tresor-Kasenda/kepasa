<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->configureComponents();
        Blade::component('layouts.app', 'app-layout');
        Blade::component('layouts.organiser', 'organiser-layout');
        Blade::component('admins.components.brandcrump', 'brandcrumb');
    }

    protected function configureComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (): void {
            $this->registerComponent('icon');
            $this->registerComponent('container');
            $this->registerComponent('nav-link');
            $this->registerComponent('link');
            $this->registerComponent('form-input');
            $this->registerComponent('containt');
        });
    }

    protected function registerComponent(string $component): void
    {
        Blade::component('admins.partials.'.$component, 'vex-'.$component);
    }
}
