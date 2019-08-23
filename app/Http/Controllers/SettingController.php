<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    public function index(SettingService $settingService)
    {
        $setting = Cache::rememberForever(Setting::$cacheKey, function () use ($settingService) {

            return $settingService->getSetting(['avatar', 'title', 'sketch']);
        });

        return new SettingResource($setting);
    }
}
