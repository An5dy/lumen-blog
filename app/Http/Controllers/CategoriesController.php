<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Resources\ArticleCollection;

class CategoriesController extends Controller
{
    public function articles($id)
    {
        $articles = Article::query()
            ->whereHas('category', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->where('is_published', Article::UPPER)
            ->paginate(10, [
                'id', 'category_id', 'title', 'sketch', 'skims', 'likes', 'comments', 'created_at'
            ]);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }
}
