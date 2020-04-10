<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AboutResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'main' => $this->main ?? '',
        ];
    }
}
