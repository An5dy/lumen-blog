<?php

namespace App\Http\Controllers\API\Setting;

use App\Services\ImageService;
use App\Services\SettingService;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UploadImageResource;

class UpdateAvatar extends Controller
{
    public function __invoke(ImageService $imageService, SettingService $settingService, ImageRequest $request)
    {
        $path = $imageService->upload($request->image);
        $settingService->updateOrCreate(['avatar' => $path]);

        return (new UploadImageResource(compact('path')))->withMessage('头像上传成功');
    }
}
