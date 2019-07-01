<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
