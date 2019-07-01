<?php

namespace App\Providers;

use App\Listeners\UpdateSkims;
use App\Events\ArticleSkimmed;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ArticleSkimmed::class => [
            UpdateSkims::class,
        ],
    ];
}
