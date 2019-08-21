<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Events\ArticleSkimmedEvent;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->with('category')
            ->latest()
            ->paginate(10, [
                'id', 'category_id', 'title', 'sketch', 'skims', 'likes', 'comments', 'created_at'
            ]);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }

    public function show($id)
    {
        $article = Article::query()
            ->with(['category', 'tags'])
            ->findOrFail($id);

        event(new ArticleSkimmedEvent($article));

        return (new ArticleResource($article))->withMessage('文章获取成功');
    }
}