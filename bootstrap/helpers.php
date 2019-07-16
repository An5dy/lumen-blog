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

if (!function_exists('generate_filename')) {
    /**
     * @use      [生成文件名]
     * @Author   ze <846562014@qq.com>
     * @date     2019-07-12 15:30
     * @param string $suffix
     * @return string
     * @throws Exception
     */
    function generate_filename(string $suffix = '.jpg'): string
    {
        return date('YmdHis', time()) .
            str_pad(random_int(0, 10000000), 8, 0, STR_PAD_LEFT) .
            $suffix;
    }
}
