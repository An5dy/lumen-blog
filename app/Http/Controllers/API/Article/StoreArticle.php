<?php

namespace App\Http\Controllers\API\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Jobs\GenerateTags;
use App\Models\Article;
use App\Services\ArticleService;

class StoreArticle extends Controller
{
    public function __invoke(ArticleService $articleService, ArticleRequest $request)
    {
        $article = new Article($request->only(['title', 'main', 'category_id']));
        $article->sketch = $articleService->generateSketch($request->main);
        $article->save();

        $this->dispatch(new GenerateTags($article));

        return $this->response->created();
    }
}
