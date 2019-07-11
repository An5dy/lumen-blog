<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Helpers;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'main'          => $this->main,
            'category'      => CategoryResource::make($this->category),
        ];
    }
}
