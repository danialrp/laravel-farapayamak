<?php

namespace DanialPanah\Farapayamak;

use Illuminate\Support\ServiceProvider;

/**
 * Class FarapayamakServiceProvider
 *
 * @package \DanialPanah\Farapayamak
 */
class FarapayamakServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('farapayamak', function ($app) {
            return new Farapayamak();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'farapayamak');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('farapayamak.php'),
            ], 'config');
        }
    }
}