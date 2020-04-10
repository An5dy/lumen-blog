<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
}
