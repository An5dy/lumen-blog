<?php

namespace App\Listeners;

use App\Events\ArticleSkimmedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UpdateSkims
{
    public function handle(ArticleSkimmedEvent $event)
    {
        $article = $event->getArticle();

        $cacheKey = $this->getCacheKey($article->id);
        $ip = Request::capture()->ip();

        if (! Redis::command('SISMEMBER', [$cacheKey, $ip])) {
            Redis::command('SADD', [$cacheKey, $ip]); // 保存数据到集合
            Redis::command('EXPIRE', [$cacheKey, 600]); // 设置访问失效时间，超过设置时间就当重新访问
            $article->increment('skims'); // 访问记录加 1
        }
    }

    protected function getCacheKey(int $articleId)
    {
        return 'article:'.$articleId.':viewed';
    }
}
