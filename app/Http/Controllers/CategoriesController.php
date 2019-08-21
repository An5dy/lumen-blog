<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Http\Resources\ArticleCollection;

class CategoriesController extends Controller
{
    public function articles(int $id)
    {
        $categoryIds = Category::getChildrenIds($id);

        $articles = Article::query()
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->paginate(10, [
                'id', 'category_id', 'title', 'sketch', 'skims', 'likes', 'comments', 'created_at'
            ]);

        return (new ArticleCollection($articles))->withMessage('文章列表获取成功');
    }
}
