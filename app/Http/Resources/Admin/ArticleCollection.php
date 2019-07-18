<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Helpers;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'title'         => $item->title,
                    'skims'         => $item->skims,
                    'likes'         => $item->likes,
                    'comments'      => $item->comments,
                    'is_published'  => $item->is_published,
                    'created_at'    => $item->created_at->toDateTimeString(),
                    'category'      => CategoryResource::make($item->category),
                    'tags'          => $item->tags->map(function ($tag) {
                        return TagResource::make($tag);
                    }),
                ];
            })
        ];
    }
}
