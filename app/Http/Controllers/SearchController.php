<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\QueryRequest;
use App\Http\Resources\ArticleCollection;

class SearchController extends Controller
{
    public function index(QueryRequest $request)
    {
        $articles = Article::search($request->get('query'))
            ->where('is_published', Article::UPPER)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return (new ArticleCollection($articles))->withMessage('搜索成功');
    }
}
