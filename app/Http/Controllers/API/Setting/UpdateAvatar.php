<?php

namespace App\Http\Controllers\API\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\UploadImageResource;
use App\Services\ImageService;
use App\Services\SettingService;

class UpdateAvatar extends Controller
{
    public function __invoke(ImageService $imageService, SettingService $settingService, ImageRequest $request)
    {
        $path = $imageService->upload($request->image);
        $settingService->updateOrCreate(['avatar' => $path]);

        return (new UploadImageResource(compact('path')))->withMessage('头像上传成功');
    }
}
