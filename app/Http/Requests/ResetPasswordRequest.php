<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;

class ResetPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'old_password' => [
                'bail',
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $user = $this->user();
                    if (! Hash::check($value, $user->password)) {
                        return $fail('原密码错误');
                    }
                },
            ],
            'new_password' => 'bail|required|string|confirmed',
        ];
    }
}
