<?php

namespace App\Providers;

use Laravel\Scout\EngineManager;
use Laravel\Scout\ScoutServiceProvider;
use Laravel\Scout\Console\FlushCommand;
use Laravel\Scout\Console\ImportCommand;

class LumenScoutServiceProvider extends ScoutServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(EngineManager::class, function ($app) {
            return new EngineManager($app);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportCommand::class,
                FlushCommand::class,
            ]);
        }
    }

    public function provides()
    {
        return [EngineManager::class];
    }
}
