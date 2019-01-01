<?php

namespace DesignByCode\Realtor\Providers;


use DesignByCode\Realtor\RealtorSetup\RealtorSetup;
use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class RealtorServiceProvider extends ServiceProvider
{

    protected $commands = [
        "DesignByCode\Realtor\Console\Commands\RealtorInstall"
    ];
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

        PresetCommand::macro('realtor', function ($command) {
            RealtorSetup::install();

            $command->info('Thanks for using Realtor');
        });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPackage();
    }


    /**
     * [registerPackage description]
     * @return [type] [description]
     */
    private function registerPackage()
    {
        $this->commands($this->commands);
    }


}
