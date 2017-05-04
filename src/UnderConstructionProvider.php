<?php

namespace Jrl05k\UnderConstruction;

use Illuminate\Support\ServiceProvider;

class UnderConstructionProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'underconstruction');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Jrl05k\UnderConstruction\UnderConstructionController');
    }
}
