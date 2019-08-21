<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class FlushArticleCache extends Job
{
    public function __construct()
    {
        //
    }

    /**
     * @use      [释放文章相关缓存]
     * @Author   ze <846562014@qq.com>
     * @date     2019-08-21 14:00
     */
    public function handle()
    {
        Cache::tags([Article::$cacheTag])->flush();
    }
}
