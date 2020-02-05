<?php

namespace App\Http\Resources;

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
                    'sketch'        => $item->sketch,
                    'skims'         => $item->skims,
                    'likes'         => $item->likes,
                    'comments'      => $item->comments,
                    'created_at'    => $item->created_at->toDatetimeString(),
                    'category'      => CategoryResource::make($item->category),
                ];
            })
        ];
    }
}
