<?php

namespace App\Http\Controllers\API\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class StoreCategory extends Controller
{
    public function __invoke(CategoryRequest $request)
    {
        $category = Category::query()
            ->create(array_merge([
                'parent_id' => $request->get('category_id'),
            ], $request->only('title')));

        return (new CategoryResource($category))->withMessage('分类添加成功');
    }
}
