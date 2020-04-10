<?php

namespace App\Http\Requests;

class SettingRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'bail|required|string|max:50',
            'sketch' => 'bail|required|string|max:255',
        ];
    }
}
