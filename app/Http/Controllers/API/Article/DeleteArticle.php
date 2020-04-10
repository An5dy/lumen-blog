<?php

namespace App\Http\Controllers\API\Article;

use App\Http\Controllers\Controller;
use App\Jobs\FlushArticleCache;
use App\Services\ArticleService;

class DeleteArticle extends Controller
{
    public function __invoke(ArticleService $articleService, int $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->delete();

        $this->dispatch(new FlushArticleCache());

        return $this->response->noContent();
    }
}
