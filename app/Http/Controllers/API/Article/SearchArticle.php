<?php

namespace App\Http\Controllers\API\Article;

use App\Models\Article;
use App\Http\Requests\QueryRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SearchCollection;

class SearchArticle extends Controller
{
    public function __invoke(QueryRequest $request)
    {
        $articles = Article::search($request->get('query', ''))
            ->query(function ($query) {
                $query->with('category');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return (new SearchCollection($articles))->withMessage('搜索成功。');
    }
}
