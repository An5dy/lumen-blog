<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Tymon\JWTAuth\Facades\JWTAuth;

class PruneOldToken
{
    public function handle(LoginEvent $event)
    {
        $user = $event->getUser();
        if ($token = $user->api_token) {
            $oldToken = JWTAuth::setToken($token);
            if ($oldToken->check()) {
                $oldToken->invalidate();// 失效旧 token
            }
        }

        $user->update(['api_token' => $event->getToken()]);
    }
}
