<?php

namespace DesignByCode\Realtor\Providers;

use DesignByCode\Realtor\Models\Property;
use Illuminate\Support\ServiceProvider;

class RealtorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__.'/../../database/seeds' => database_path('seeds'),
        ], 'Realtor Seeds');

        $this->publishes([
           __DIR__ .'/../config' => config_path()
        ], 'Realtor Configs');


        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../views', 'realtor');


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
