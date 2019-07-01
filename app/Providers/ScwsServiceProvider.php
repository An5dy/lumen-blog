<?php

namespace App\Providers;

use App\Extensions\Scws\Scws;
use Illuminate\Support\ServiceProvider;

class ScwsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/scws.php', 'scws');

        $this->app->singleton('scws', function ($app) {
            $config = $app->config->get('scws');

            return new Scws($config);
        });
    }

    public function provides()
    {
        return ['scws'];
    }
}
