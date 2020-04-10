<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
