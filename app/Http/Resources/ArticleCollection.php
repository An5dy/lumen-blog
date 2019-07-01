<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    use Helpers;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
