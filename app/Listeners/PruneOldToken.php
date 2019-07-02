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
                $oldToken->invalidate();// 旧 token 失效
            }
        }

        $user->update(['api_token' => $event->getToken()]);
    }
}
