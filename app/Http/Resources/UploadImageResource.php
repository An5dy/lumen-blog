<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadImageResource extends JsonResource
{
    use Helpers;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
