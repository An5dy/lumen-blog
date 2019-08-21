<?php

namespace App\Http\Controllers\Admin;

use App\Services\ImageService;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UploadImageResource;

class ImagesController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function store(ImageRequest $request)
    {
        $path = $this->imageService->upload($request->image);

        return (new UploadImageResource(compact('path')))->withMessage('图片上传成功');
    }

    public function destroy(ImageRequest $request)
    {
        $this->imageService->delete($request->img_path);

        return $this->response->noContent();
    }
}
