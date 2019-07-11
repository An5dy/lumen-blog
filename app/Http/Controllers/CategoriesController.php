<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryCollection;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->get();

        return (new CategoryCollection($categories))->withMessage('分类获取成功');
    }
}
