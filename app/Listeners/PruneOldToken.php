<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Support\Facades\Auth;

class PruneOldToken
{
    public function handle(LoginEvent $event)
    {
        $user = $event->getUser();

        if ($token = $user->api_token) {
            $oldToken = Auth::setToken($token);
            if ($oldToken->check()) {
                $oldToken->invalidate();// 旧 token 失效
            }
        }

        $user->update(['api_token' => $event->getToken()]);
    }
}
