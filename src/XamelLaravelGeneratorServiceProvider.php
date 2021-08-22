<?php

namespace Xamel\LaravelGenerator;

use Illuminate\Support\ServiceProvider;
use Xamel\LaravelGenerator\Services\LaravelGeneratorService;

class XamelLaravelGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel_generator_service', function () {
            return new LaravelGeneratorService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}