<?php

namespace App\Http\Resources;

use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Http\Resources\Json\Resource;

class TokenResource extends Resource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'access_token'  => $this->resource['token'],
            'expires_in'    => (int)config('jwt.ttl'),
            'token_type'    => 'Bearer'
        ];
    }
}
