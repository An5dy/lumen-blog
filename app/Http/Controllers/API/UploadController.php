<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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
        Log::info('server:', $_SERVER);
        [$verify, $data] = Storage::verify();

        if (! $verify) {
            Log::warning('回调签名失败:', $data);

            return response()->json($data, 500);
        }
        Log::warning('回调签名:', $data);

        return response()->json($data, 200);
    }
}
