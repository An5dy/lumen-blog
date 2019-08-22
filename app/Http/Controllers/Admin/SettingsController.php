<?php

namespace App\Http\Controllers\Admin;

use App\Services\ImageService;
use App\Services\SettingService;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;
use App\Http\Resources\Admin\UploadImageResource;

class SettingsController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = $this->settingService->getSetting(['avatar', 'title', 'sketch']);

        return new SettingResource($setting);
    }

    public function updateOrCreate(SettingRequest $request)
    {
        $this->settingService->updateOrCreate($request->only(['title', 'sketch']));

        return $this->response->noContent();
    }

    public function avatar(ImageService $imageService, ImageRequest $request)
    {
        $path = $imageService->upload($request->image);
        $this->settingService->updateOrCreate(['avatar' => $path]);

        return (new UploadImageResource(compact('path')))->withMessage('头像上传成功');
    }
}
