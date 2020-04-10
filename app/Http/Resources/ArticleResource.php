<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'sketch'        => $this->sketch,
            'main'          => $this->main,
            'skims'         => $this->skims,
            'likes'         => $this->likes,
            'comments'      => $this->comments,
            'created_at'    => $this->created_at->toDateTimeString(),
            'category'      => CategoryResource::make($this->category),
            'tags'          => $this->tags->implode('title', ','),
            'categories'    => $this->category->ancestors->map(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                ];
            }),
        ];
    }
}
