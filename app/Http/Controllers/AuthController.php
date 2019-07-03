<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use App\Events\LogoutEvent;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\TokenResource;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['account', 'password']);

        if ($token = JWTAuth::attempt($credentials)) {
            event(new LoginEvent(JWTAuth::user(), $token));

            return (new TokenResource(compact('token')))->withMessage('登录成功');
        }

        $this->response->errorUnauthorized('用户名或密码错误');
    }

    public function logout()
    {
        event(new LogoutEvent(JWTAuth::user()));
        JWTAuth::parseToken()->invalidate();

        return $this->response->noContent();
    }
}
