<?php

namespace App\Models\Scopes;

use App\Models\Article;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IsPublishedScope implements Scope
{
    /**
     * @use      [设置文章发布全局作用域]
     * @Author   ze <846562014@qq.com>
     * @date     2019-08-19 16:56
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('is_published', Article::UPPER);
    }
}