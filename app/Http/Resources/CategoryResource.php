<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
