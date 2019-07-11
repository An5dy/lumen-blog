<?php

namespace App\Http\Requests;

class AboutRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'main' => 'bail|required|string',
        ];
    }
}