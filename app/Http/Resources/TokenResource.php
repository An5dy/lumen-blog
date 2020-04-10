<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'access_token'  => $this->resource['token'],
            'expires_in'    => (int) config('jwt.ttl'),
            'token_type'    => 'Bearer',
        ];
    }
}
