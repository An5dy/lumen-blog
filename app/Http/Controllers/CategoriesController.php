<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\CategoryCollection;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->get();

        return (new CategoryCollection($categories))->withMessage('分类获取成功');
    }

    public function store(ArticleRequest $request)
    {
        Category::query()->create($request->only('title'));

        return $this->response->created();
    }

    public function update(CategoryService $categoryService, ArticleRequest $request, $id)
    {
        $article = $categoryService->findCategoryByPrimaryKey($id);
        $article->update($request->only('title'));

        return $this->response->noContent();
    }

    public function destroy(CategoryService $categoryService, $id)
    {
        $article = $categoryService->findCategoryByPrimaryKey($id);
        $article->delete();

        return $this->response->noContent();
    }
}
