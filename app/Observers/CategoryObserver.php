<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function creating(Category $category)
    {
        $level = 0;
        $path = '-';
        if (! is_null($category->parent_id)) {
            $level = $category->parent->level + 1;
            $path = $category->parent->path.$category->parent_id.$path;
        }
        $category->level = $level;
        $category->path = $path;
    }

    public function created()
    {
        $this->releaseCache();
    }

    public function updated()
    {
        $this->releaseCache();
    }

    public function deleted()
    {
        $this->releaseCache();
    }

    private function releaseCache()
    {
        Cache::forget(Category::$cacheKey);
    }
}
