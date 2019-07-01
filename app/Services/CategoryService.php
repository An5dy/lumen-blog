<?php

namespace App\Services;

use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryService
{
    public function findCategoryByPrimaryKey($primaryKey)
    {
        $category =  Category::query()->find($primaryKey);

        if (empty($category)) {
            throw  new HttpException(Response::HTTP_NOT_FOUND, '分类不存在');
        }

        return $category;
    }
}