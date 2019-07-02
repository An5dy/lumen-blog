<?php

namespace App\Events;

use App\Models\User;

class LoginEvent extends Event
{
    protected $user;

    protected $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getToken()
    {
        return $this->token;
    }
}
