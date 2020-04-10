<?php

namespace App\Http\Controllers\API\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\Cache;

class ShowSetting extends Controller
{
    public function __invoke(SettingService $settingService)
    {
        $setting = Cache::rememberForever(Setting::$cacheKey, function () use ($settingService) {
            return $settingService->getSetting(['avatar', 'title', 'sketch']);
        });

        return new SettingResource($setting);
    }
}
