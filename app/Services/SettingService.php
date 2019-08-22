<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function getSetting($columns = ['*'])
    {
        return Setting::query()
            ->orderByDesc('id')
            ->first($columns);
    }

    public function updateOrCreate($attributes)
    {
        $setting = $this->getSetting();

        if (empty($setting)) {
            Setting::query()->create($attributes);
        } else {
            $setting->update($attributes);
        }
    }
}