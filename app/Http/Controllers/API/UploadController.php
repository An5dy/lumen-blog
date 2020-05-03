<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function direct()
    {
        return Storage::signatureConfig(
            $prefix = '/',
            $callBackUrl = url('api/upload/verify'),
            $customData = [],
            $expire = 30
        );
    }

    public function verify()
    {
        [$verify, $data] = Storage::verify();

        if (!$verify) {
            return response()->json($data, 500);
        }

        return response()->json($data, 200);
    }
}
