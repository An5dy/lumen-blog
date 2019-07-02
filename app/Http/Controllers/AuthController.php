<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TokenResource;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['account', 'password']);

        if ($token = Auth::attempt($credentials)) {
            event(new LoginEvent(Auth::user(), $token));

            return (new TokenResource(compact('token')))->withMessage('登录成功');
        }

        return $this->response->errorUnauthorized('用户名或密码错误');
    }
}
