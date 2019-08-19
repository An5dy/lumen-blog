<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\IsPublishedScope;

class Article extends Model
{
    use Searchable;

    const LOWER = 0;// 下架

    const UPPER = 1;// 上架

    protected $fillable = [
        'title', 'sketch', 'main', 'category_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsPublishedScope());
    }

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

    public function toSearchableArray()
    {
        return $this->only('id', 'title', 'main');
    }
}
