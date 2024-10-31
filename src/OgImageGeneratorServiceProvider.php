<?php

namespace Paulund\OgImageGenerator;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Paulund\OgImageGenerator\Console\Commands\DeleteOldImages;

class OgImageGeneratorServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register() {}

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Http/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'paulund/og-image-generator');
        $this->publishes([
            __DIR__.'/../config' => config_path(),
        ], 'paulund/og-image-generator');

        if ($this->app->runningInConsole()) {
            $this->commands([
                DeleteOldImages::class,
            ]);
        }

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('og-image:delete-old-images')->daily();
        });
    }
}
