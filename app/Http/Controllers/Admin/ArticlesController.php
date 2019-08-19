<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Jobs\GenerateTags;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Scopes\IsPublishedScope;
use App\Http\Resources\Admin\ArticleResource;
use App\Http\Resources\Admin\ArticleCollection;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->withoutGlobalScope(IsPublishedScope::class)
            ->with(['category', 'tags'])
            ->orderByDesc('created_at')
            ->paginate(null, [
                'id', 'category_id', 'title', 'skims', 'likes', 'comments', 'created_at', 'is_published'
            ]);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }

    public function store(ArticleService $articleService, ArticleRequest $request)
    {
        $article = new Article($request->only(['title', 'main', 'category_id']));
        $article->sketch = $articleService->generateSketch($request->main);
        $article->save();

        $this->dispatch(new GenerateTags($article));

        return $this->response->created();
    }

    public function show(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id, ['id', 'category_id', 'title', 'main']);
        $article->load('category');

        return (new ArticleResource($article))->withMessage('文章获取成功');
    }

    public function update(ArticleService $articleService, ArticleRequest $request, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->fill($request->only(['title', 'main', 'category_id']));
        $article->sketch = $articleService->generateSketch($request->main);
        $article->save();

        $this->dispatch(new GenerateTags($article));

        return $this->response->noContent();
    }

    public function destroy(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->delete();

        return $this->response->noContent();
    }

    public function upper(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->is_published = Article::UPPER;
        $article->save();

        return $this->response->noContent();
    }

    public function lower(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->is_published = Article::LOWER;
        $article->save();

        return $this->response->noContent();
    }
}
