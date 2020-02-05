<?php

namespace App\Http\Controllers\API\Image;

use App\Services\ImageService;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;

class DeleteImage extends Controller
{
    public function __invoke(ImageService $imageService, ImageRequest $request)
    {
        $imageService->delete($request->img_path);

        return $this->response->noContent();
    }
}
