<?php

namespace App\Http\Requests;

class AuthRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'account'   => 'bail|required|string|max:255',
            'password'  => 'bail|required|string|max:255',
        ];
    }
}