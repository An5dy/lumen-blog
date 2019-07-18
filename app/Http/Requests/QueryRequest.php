<?php

namespace App\Http\Requests;

class QueryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'query' => 'bail|string',
        ];
    }
}