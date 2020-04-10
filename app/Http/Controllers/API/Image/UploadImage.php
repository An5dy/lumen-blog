<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Resources\UploadImageResource;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UploadImage extends Controller
{
    public function __invoke(ImageService $imageService, Request $request)
    {
        $path = $imageService->upload($request->image);

        return (new UploadImageResource(compact('path')))->withMessage('图片上传成功');
    }
}
