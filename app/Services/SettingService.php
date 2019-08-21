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
}