<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class ArticleRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'bail|required|string|unique:categories|max:255',
                ];
            case 'PUT':
            case 'PATCH':
                $id = Arr::last($this->route())['category'];
                return [
                    'title' => [
                        'bail',
                        'required',
                        'string',
                        Rule::unique('categories')->ignore($id),
                        'max:255',
                    ],
                ];
        }
    }
}