<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use App\Events\LogoutEvent;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\AuthRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['account', 'password']);

        if ($token = JWTAuth::attempt($credentials)) {
            event(new LoginEvent(JWTAuth::user(), $token));

            return response()->json([
                'message' => '登录成功',
                'status_code' => Response::HTTP_OK,
            ])->cookie(cookie_token($token));
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
