<?php

namespace App\Listeners;

use App\Events\LogoutEvent;

class PruneApiToken
{
    public function handle(LogoutEvent $event)
    {
        $user = $event->getUser();

        $user->update(['api_token' => null]);
    }
}
