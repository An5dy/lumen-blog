<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\QueryRequest;
use App\Http\Resources\SearchCollection;

class SearchController extends Controller
{
    public function index(QueryRequest $request)
    {
        $articles = Article::search($request->get('query', ''))
            ->query(function ($query) {
                $query->with('category');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return (new SearchCollection($articles))->withMessage('搜索成功');
    }
}
