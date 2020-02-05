<?php

namespace App\Http\Controllers\API\Category;

use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class DeleteCategory extends Controller
{
    public function __invoke(CategoryService $categoryService, int $id)
    {
        $article = $categoryService->findCategoryByPrimaryKey($id);
        $article->delete();

        return $this->response->noContent();
    }
}
