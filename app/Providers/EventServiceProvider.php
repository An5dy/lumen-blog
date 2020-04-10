<?php

namespace App\Providers;

use App\Events\ArticleSkimmedEvent;
use App\Events\LoginEvent;
use App\Events\LogoutEvent;
use App\Listeners\PruneApiToken;
use App\Listeners\PruneOldToken;
use App\Listeners\UpdateSkims;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ArticleSkimmedEvent::class => [
            UpdateSkims::class,
        ],
        LoginEvent::class => [
            PruneOldToken::class,
        ],
        LogoutEvent::class => [
            PruneApiToken::class,
        ],
    ];
}
