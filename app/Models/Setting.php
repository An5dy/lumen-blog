<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $fillable = [
        'avatar',
        'title',
        'sketch',
    ];

    public $timestamps = false;

    public static $cacheKey = 'setting';

    public static function boot()
    {
        parent::boot();
        // 清除缓存
        static::saved(function () {
            Cache::forget(static::$cacheKey);
        });
    }
}
