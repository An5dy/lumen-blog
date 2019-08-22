<?php

namespace App\Http\Requests;

class SettingRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'bail|required|string',
            'sketch' => 'bail|required|string',
        ];
    }
}