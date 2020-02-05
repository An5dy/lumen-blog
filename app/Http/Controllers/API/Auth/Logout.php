<?php

namespace App\Http\Controllers\API\Auth;

use App\Events\LogoutEvent;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class Logout extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        event(new LogoutEvent(JWTAuth::user()));
        JWTAuth::parseToken()->invalidate();

        return $this->response->noContent();
    }
}
