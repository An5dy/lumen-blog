<?php

namespace App\Models;

use App\Models\Scopes\IsPublishedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;

    protected $fillable = [
        'title', 'sketch', 'main', 'category_id',
    ];

    public static $archiveCacheKey = 'archives';

    public static $cacheTag = 'article';

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
        return $query->where('title', 'like', '%'.$title.'%');
    }

    public function toSearchableArray()
    {
        return $this->only('id', 'title', 'main');
    }

    public static function getArchives()
    {
        return Cache::tags([self::$cacheTag])
            ->rememberForever(self::$archiveCacheKey, function () {
                return self::query()
                    ->latest()
                    ->get(['id', 'title', 'created_at'])
                    ->each(function ($archive) {
                        $archive->mark = Carbon::parse($archive->created_at)->format('M, Y');
                    })
                    ->groupBy('mark');
            });
    }
}
