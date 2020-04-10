<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class ArticleRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'category_id' => $this->categoryIdValidateRules(),
                    'title' => 'bail|required|string|unique:articles|max:100',
                    'main' => 'bail|required|string',
                ];
            case 'PUT':
            case 'PATCH':
                $id = Arr::last($this->route())['article'];

                return [
                    'category_id' => $this->categoryIdValidateRules(),
                    'title' => [
                        'bail',
                        'required',
                        'string',
                        Rule::unique('articles')->ignore($id),
                        'max:100',
                    ],
                    'main' => 'bail|required|string',
                ];
        }
    }

    protected function categoryIdValidateRules()
    {
        return [
            'bail',
            'required',
            'integer',
            function ($attribute, $value, $fail) {
                if (! Category::query()->find($value)) {
                    return $fail('文章分类不存在');
                }
            },
        ];
    }
}
