<?php

namespace App\Models\Scopes;

use App\Enums\ArticlePublishStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class IsPublishedScope implements Scope
{
    /**
     * @use         [设置文章发布全局作用域]
     * @Author      an5dy <846562014@qq.com>
     * @datetime    2020/2/5 11:30 下午
     * @param Builder $builder
     * @param Model $model
     * @return Builder
     */
    public function apply(Builder $builder, Model $model): Builder
    {
        return is_admin_path() ?
            $builder :
            $builder->where('is_published', ArticlePublishStatus::UPPER);
    }
}
