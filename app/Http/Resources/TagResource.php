<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TagResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
