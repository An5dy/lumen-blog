<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->orderByDesc('id')
            ->get();

        return (new CategoryCollection($categories))->withMessage('分类获取成功');
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::query()->create($request->only('title'));

        return (new CategoryResource($category))->withMessage('分类添加成功');
    }

    public function update(CategoryService $categoryService, CategoryRequest $request, $id)
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
