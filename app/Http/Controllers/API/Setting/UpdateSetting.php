<?php

namespace App\Http\Controllers\API\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Services\SettingService;

class UpdateSetting extends Controller
{
    public function __invoke(SettingService $settingService, SettingRequest $request)
    {
        $settingService->updateOrCreate($request->only(['title', 'sketch']));

        return $this->response->noContent();
    }
}
