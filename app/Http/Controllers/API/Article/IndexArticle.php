<?php

namespace App\Http\Controllers\API\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;

class IndexArticle extends Controller
{
    public function __invoke()
    {
        $articles = Article::query()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(is_admin_path() ? null : 10, [
                'id', 'category_id', 'title', 'skims',
                'sketch', 'likes', 'comments', 'created_at', 'is_published',
            ]);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功。');
    }
}
