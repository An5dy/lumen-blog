<?php

namespace App\Http\Requests;

class ImageRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'image' => 'bail|required|image',
                ];
            case 'DELETE':
                return [
                    'img_path' => 'bail|required|url',
                ];
        }
    }
}
