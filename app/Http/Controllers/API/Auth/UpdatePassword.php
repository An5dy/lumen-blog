<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Controller
{
    public function __invoke(ResetPasswordRequest $request)
    {
        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->response->noContent();
    }
}
