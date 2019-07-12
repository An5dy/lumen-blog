<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RefreshToken extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        $this->checkForToken($request);

        try {
            if ($this->auth->parseToken()->authenticate()) {// token 认证
                return $next($request);
            }
            throw new UnauthorizedHttpException('jwt-auth', '用户认证失败');
        } catch (TokenExpiredException $exception) {
            try {
                $token = $this->auth->parseToken()->refresh();// 刷新 token
                // 使用一次性登录以保证此次请求的成功
                Auth::onceUsingId($this->auth
                    ->manager()
                    ->getPayloadFactory()
                    ->buildClaimsCollection()
                    ->toPlainArray()['sub']);
            } catch (JWTException $exception) {
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                throw new UnauthorizedHttpException('jwt-auth', '用户认证失败');
            }
        } catch (TokenBlacklistedException $exception) {
            // token 已拉入黑名单
            throw new UnauthorizedHttpException('jwt-auth', '用户认证失败');
        }

        return $this->setAuthenticationHeader($next($request), $token);
    }
}
