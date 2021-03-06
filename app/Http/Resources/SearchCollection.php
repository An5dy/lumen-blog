<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchCollection extends ResourceCollection
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($article) {
                return [
                    'id'    => $article->id,
                    'value' => $article->title,
                ];
            }),
        ];
    }
}
