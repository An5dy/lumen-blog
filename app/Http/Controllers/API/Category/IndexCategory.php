<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;

class IndexCategory extends Controller
{
    public function __invoke()
    {
        $categories = Category::getCategoryTree();

        return (new CategoryCollection($categories))->withMessage('分类获取成功');
    }
}
