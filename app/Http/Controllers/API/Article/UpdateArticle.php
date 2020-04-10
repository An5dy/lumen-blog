<?php

namespace App\Http\Controllers\API\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Jobs\FlushArticleCache;
use App\Jobs\GenerateTags;
use App\Services\ArticleService;

class UpdateArticle extends Controller
{
    public function __invoke(ArticleService $articleService, ArticleRequest $request, int $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->fill($request->only(['title', 'main', 'category_id']));
        $article->sketch = $articleService->generateSketch($request->main);
        $article->save();

        $this->dispatch(new GenerateTags($article));
        $this->dispatch(new FlushArticleCache());

        return $this->response->noContent();
    }
}
