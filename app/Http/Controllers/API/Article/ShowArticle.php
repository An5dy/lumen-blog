<?php

namespace App\Http\Controllers\API\Article;

use App\Events\ArticleSkimmedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;

class ShowArticle extends Controller
{
    public function __invoke(ArticleService $articleService, int $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->load('category', 'tags');

        if (! is_admin_path()) {
            event(new ArticleSkimmedEvent($article));
        }

        return (new ArticleResource($article))->withMessage('文章获取成功。');
    }
}
