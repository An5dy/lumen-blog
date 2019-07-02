<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TokenResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'token_type'    => 'Bearer',
            'expires_in'    => (int)config('jwt.ttl') * 60,
            'access_token'  => $this->resource['token'],
        ];
    }
}
