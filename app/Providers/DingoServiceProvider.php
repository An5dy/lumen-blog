<?php

namespace App\Providers;

use App\Exceptions\DingoHandler;
use Dingo\Api\Provider\LumenServiceProvider;

class DingoServiceProvider extends LumenServiceProvider
{
    public function registerExceptionHandler()
    {
        $this->app->singleton('api.exception', function ($app) {
            return new DingoHandler($app['Illuminate\Contracts\Debug\ExceptionHandler'],
                $this->config('errorFormat'),
                $this->config('debug'));
        });
    }
}
