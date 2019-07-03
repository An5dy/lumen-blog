<?php

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;

if (!function_exists('cookie_token')) {
    /**
     * @use      [cookie 设置 token]
     * @Author   ze <846562014@qq.com>
     * @date     2019-07-03 11:08
     * @param string $token
     * @return Cookie
     */
    function cookie_token(string $token)
    {
        return new Cookie('token',
            $token,
            Carbon::now()->addMinutes((int)config('jwt.ttl')),
            null,
            null,
            false,
            true
        );
    }
}
