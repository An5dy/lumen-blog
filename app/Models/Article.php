<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const TYPE_ARTICLE = 1;// 普通文章

    const TYPE_PROFILE = 2;// 个人简介

    const LOWER = 0;// 下架

    const UPPER = 1;// 上架

    protected $fillable = [
        'title', 'main', 'category_id', 'type'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }
}
