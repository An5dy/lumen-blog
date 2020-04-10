<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    use Helpers;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
