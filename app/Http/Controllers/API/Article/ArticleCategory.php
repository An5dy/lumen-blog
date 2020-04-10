<?php

namespace App\Http\Controllers\API\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use App\Models\Category;

class ArticleCategory extends Controller
{
    public function __invoke(int $id)
    {
        $categoryIds = Category::getChildrenIds($id);

        $articles = Article::query()
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->paginate(10, [
                'id', 'category_id', 'title', 'sketch', 'skims', 'likes', 'comments', 'created_at',
            ]);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }
}
