<?php

namespace App\Http\Controllers\API\Category;

use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class UpdateCategory extends Controller
{
    public function __invoke(CategoryService $categoryService, CategoryRequest $request, int $id)
    {
        $article = $categoryService->findCategoryByPrimaryKey($id);
        $article->update($request->only('title'));

        return $this->response->noContent();
    }
}
