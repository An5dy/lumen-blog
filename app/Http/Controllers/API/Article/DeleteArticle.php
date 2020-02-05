<?php

namespace App\Http\Controllers\API\Article;

use App\Jobs\FlushArticleCache;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;

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
