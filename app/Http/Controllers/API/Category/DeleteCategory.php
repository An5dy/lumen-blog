<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class DeleteCategory extends Controller
{
    public function __invoke(CategoryService $categoryService, int $id)
    {
        $article = $categoryService->findCategoryByPrimaryKey($id);
        $article->delete();

        return $this->response->noContent();
    }
}
