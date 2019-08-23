<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['main'];

    protected $hidden = ['updated_at'];

    public static $cacheKey = 'about';

    public static function boot()
    {
        parent::boot();
        // 清除缓存
        static::saved(function () {
            Cache::forget(static::$cacheKey);
        });
    }
}
