<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Events\ArticleSkimmedEvent;
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
            ->paginate(10);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }

    public function show(ArticleService $articleService, $id)
    {
        $article = $articleService->findArticleByPrimaryKey($id);
        $article->load('category', 'tags');

        event(new ArticleSkimmedEvent($article));

        return (new ArticleResource($article))->withMessage('文章获取成功');
    }
}
