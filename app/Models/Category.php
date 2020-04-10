<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $fillable = [
        'title',
        'parent_id',
        'level',
        'path',
    ];

    public $timestamps = false;

    public static $cacheKey = 'categories';

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function getParentIdsAttribute()
    {
        return array_filter(explode('-', trim($this->path, '-')));
    }

    public function getAncestorsAttribute()
    {
        return $this->newQuery()
            ->whereIn('id', $this->parent_ids)
            ->get();
    }

    /**
     * @use      [生成分类树]
     * @Author   ze <846562014@qq.com>
     * @date     2019-08-20 15:46
     * @return Collection
     */
    public static function getCategoryTree(): Collection
    {
        return Cache::rememberForever(self::$cacheKey, function () {
            $categories = self::query()
                ->get(['id', 'title', 'parent_id', 'level'])
                ->toArray();

            $items = [];
            foreach ($categories as $category) {
                $items[$category['id']] = $category;
            }
            $tree = [];
            foreach ($items as $key => $item) {
                if (isset($items[$item['parent_id']])) {
                    $items[$item['parent_id']]['children'][] = &$items[$key]; // 引用子集
                } else {
                    $tree[] = &$items[$key];
                }
            }

            return Collection::make($tree);
        });
    }

    /**
     * @use      [获取子节点IDs]
     * @Author   ze <846562014@qq.com>
     * @date     2019-08-21 10:30
     * @param int $parentId
     * @return array
     */
    public static function getChildrenIds(int $parentId): array
    {
        $tree = static::getCategoryTree()->toArray();

        $allChildren = static::getAllChildren($tree, $parentId);

        $childrenIds[] = $parentId;
        array_walk_recursive($allChildren, function ($item, $key) use (&$childrenIds) {
            if ($key === 'id') {
                $childrenIds[] = $item;
            }
        });
        sort($childrenIds);

        return $childrenIds;
    }

    /**
     * @use      [获取所有子节点]
     * @Author   ze <846562014@qq.com>
     * @date     2019-08-21 11:02
     * @param array $data
     * @param $parentId
     * @return array
     */
    public static function getAllChildren(array $data, $parentId): array
    {
        foreach ($data as $key => $value) {
            if ($value['id'] === $parentId) {
                return $value['children'] ?? [];
            }
            if (isset($value['children'])) {
                return static::getAllChildren($value['children'], $parentId);
            }
        }

        return [];
    }
}
