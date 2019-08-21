<?php

namespace app\Http\Requests;

class SettingRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'avatar' => 'bail|required|url',
            'title' => 'bail|required|string',
            'sketch' => 'bail|required|string',
        ];
    }
}