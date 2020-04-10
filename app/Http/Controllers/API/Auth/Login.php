<?php

namespace App\Http\Controllers\API\Auth;

use App\Events\LoginEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\TokenResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class Login extends Controller
{
    public function __invoke(AuthRequest $request)
    {
        $credentials = $request->only(['account', 'password']);

        if ($token = JWTAuth::attempt($credentials)) {
            event(new LoginEvent(JWTAuth::user(), $token));

            return (new TokenResource(compact('token')))->withMessage('登录成功');
        }

        $this->response->errorUnauthorized('用户名或密码错误');
    }
}
