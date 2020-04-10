<?php

namespace App\Http\Controllers\API\Article;

use App\Enums\ArticlePublishStatus;
use App\Http\Controllers\Controller;
use App\Jobs\FlushArticleCache;
use App\Services\ArticleService;

class TogglePublish extends Controller
{
    public function __invoke(ArticleService $articleService, int $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);

        $article->is_published = $article->is_published === ArticlePublishStatus::LOWER ?
            ArticlePublishStatus::UPPER :
            ArticlePublishStatus::LOWER;
        $article->save();

        $this->dispatch(new FlushArticleCache());

        return $this->response->noContent();
    }
}
