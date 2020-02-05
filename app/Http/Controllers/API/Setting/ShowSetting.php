<?php

namespace App\Http\Controllers\API\Setting;

use App\Models\Setting;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SettingResource;

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
