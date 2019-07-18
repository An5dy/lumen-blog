<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Events\ArticleSkimmedEvent;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->where('is_published', Article::UPPER)
            ->orderByDesc('created_at')
            ->paginate(10, [
                'id', 'title', 'sketch', 'skims', 'likes', 'comments', 'created_at'
            ]);

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
