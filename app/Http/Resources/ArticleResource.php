<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'title'         => $this->title,
            'main'          => $this->main,
            'skims'         => $this->skims,
            'likes'         => $this->likes,
            'comments'      => $this->comments,
            'created_at'    => $this->created_at->toFormattedDateString(),
            'category'      => CategoryResource::make($this->category),
            'tags'          => TagCollection::make($this->tags),
        ];
    }
}
