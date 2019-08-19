<?php

namespace App\Services;

use Parsedown;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Models\Scopes\IsPublishedScope;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleService
{
    public function findArticleByPrimaryKey($primaryKey, array $columns = ['*'])
    {
        $article = Article::query()
            ->withoutGlobalScope(IsPublishedScope::class)
            ->find($primaryKey, $columns);

        if (empty($article)) {
            throw new HttpException(Response::HTTP_NOT_FOUND, '文章不存在');
        }

        return $article;
    }

    public function generateSketch(string $markdown): string
    {
        $sketch = Parsedown::instance()
            ->setSafeMode(true)
            ->text($markdown);

        return Str::limit(strip_tags($sketch), 250);
    }
}