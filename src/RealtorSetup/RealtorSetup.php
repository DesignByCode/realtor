<?php

namespace DesignByCode\Realtor\RealtorSetup;

use DesignByCode\Realtor\Console\Commands\RealtorInstall;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

/**
 * Class RealtorInstall
 *
 * @package \DesignByCode\Realtor\RealtorInstall
 */
class RealtorSetup extends RealtorInstall
{

    public static function install()
    {
        static::updateWelcome();
        static::updateLayoutsTemplate();
        static::updateModels();
    }


    public static function updateLayoutsTemplate()
    {
        copy(__DIR__.'/stubs/views/layouts/app.blade.php', resource_path('/views/layouts/app.blade.php'));
    }

    public static function updateWelcome()
    {
        copy(__DIR__.'/stubs/views/welcome.blade.php', resource_path('/views/welcome.blade.php'));
    }

    public static function updateModels()
    {
        copy(__DIR__.'/stubs/Models/User.php', app_path('User.php'));
    }



}
