<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
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

    public function refresh()
    {
        try {
            $token = JWTAuth::parseToken()->refresh();

            return (new TokenResource(compact('token')))->withMessage('token 刷新成功');
        } catch (\Exception $exception) {

            $this->response->error('token 刷新失败', 500);
        }
    }

    public function logout()
    {
        JWTAuth::parseToken()->invalidate();

        return $this->response->noContent();
    }
}
