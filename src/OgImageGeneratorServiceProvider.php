<?php

namespace Paulund\OgImageGenerator;

use Illuminate\Support\ServiceProvider;

class OgImageGeneratorServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Http/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'paulund/og-image-generator');
    }
}
