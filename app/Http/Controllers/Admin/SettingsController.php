<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use app\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;

class SettingsController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = $this->settingService->getSetting();

        return new SettingResource($setting);
    }

    public function updateOrCreate(SettingRequest $request)
    {
        $setting = $this->settingService->getSetting();
        $attributes = $request->only(['avatar', 'title', 'sketch']);

        if (empty($setting)) {
            Setting::query()->create($attributes);
        } else {
            $setting->update($attributes);
        }

        return $this->response->noContent();
    }
}
