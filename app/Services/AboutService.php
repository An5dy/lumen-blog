<?php

namespace App\Services;

use App\Models\About;

class AboutService
{
    public function getAbout()
    {
        return About::query()->latest()->first();
    }
}