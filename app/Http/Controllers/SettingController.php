<?php

namespace App\Http\Controllers;

use App\Exceptions\BlogException;
use App\Services\SettingService;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    public function index(SettingService $settingService)
    {
        $setting = $settingService->getSetting(['avatar', 'title', 'sketch']);

        return new SettingResource($setting);
    }
}
