<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'name'      => $this->name,
            'account'   => $this->account
        ];
    }
}
