<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Jobs\GenerateTags;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->with(['category', 'tags'])
            ->when($title = $request->get('title', null), function ($query) use ($title) {
                $query->title($title);
            })
            ->orderByDesc('created_at')
            ->simplePaginate();

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::query()->create($request->only(['title', 'main', 'category_id']));
        $this->dispatch(new GenerateTags($article));

        return $this->response->created();
    }

    public function show(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->load('category', 'tags');

        return (new ArticleResource($article))->withMessage('文章获取成功');
    }

    public function update(ArticleService $articleService, ArticleRequest $request, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->update($request->only(['title', 'main', 'category_id']));
        $this->dispatch(new GenerateTags($article));

        return $this->response->noContent();
    }

    public function destroy(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->delete();

        return $this->response->noContent();
    }
}
