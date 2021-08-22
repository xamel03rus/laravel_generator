<?php

namespace Xamel\LaravelGenerator;

use Illuminate\Support\Facades\Facade;

class XamelLaravelGeneratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel_generator_service';
    }
}