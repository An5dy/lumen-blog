<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'main' => $this->main ?? '',
        ];
    }
}
