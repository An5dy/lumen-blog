<?php

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;

if (! function_exists('cookie_token')) {
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
            Carbon::now()->addMinutes((int) config('jwt.ttl')),
            null,
            null,
            false,
            true
        );
    }
}

if (! function_exists('generate_filename')) {
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
        return date('YmdHis', time()).
            str_pad(random_int(0, 10000000), 8, 0, STR_PAD_LEFT).
            $suffix;
    }
}

if (! function_exists('is_admin_path')) {
    /**
     * @use         [是否是 admin 路由]
     * @Author      an5dy <846562014@qq.com>
     * @datetime    2020/2/5 11:46 下午
     * @param string $pattern
     * @return bool
     */
    function is_admin_path($pattern = 'api/admin/*'): bool
    {
        return app('request')->is($pattern);
    }
}
