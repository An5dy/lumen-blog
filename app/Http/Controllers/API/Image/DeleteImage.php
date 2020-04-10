<?php

namespace App\Http\Controllers\API\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Services\ImageService;

class DeleteImage extends Controller
{
    public function __invoke(ImageService $imageService, ImageRequest $request)
    {
        $imageService->delete($request->img_path);

        return $this->response->noContent();
    }
}
