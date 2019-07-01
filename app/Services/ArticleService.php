<?php

namespace App\Services;

use App\Models\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleService
{
    public function findArticleByPrimaryKey($primaryKey)
    {
        $article = Article::query()->find($primaryKey);

        if (empty($article)) {
            throw new HttpException(Response::HTTP_NOT_FOUND, '文章不存在');
        }

        return $article;
    }
}