<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user();

        return (new UserResource($user))->withMessage('用户信息获取成功');
    }
}
