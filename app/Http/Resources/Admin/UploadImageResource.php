<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Helpers;
use Illuminate\Http\Resources\Json\Resource;

class UploadImageResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
