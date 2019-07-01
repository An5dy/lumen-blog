<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
