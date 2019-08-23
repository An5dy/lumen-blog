<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Services\AboutService;
use App\Http\Resources\AboutResource;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    public function index(AboutService $aboutService)
    {
        $about = Cache::rememberForever(About::$cacheKey, function () use ($aboutService) {
            return $aboutService->getAbout();
        });

        return (new AboutResource($about))->withMessage('操作成功');
    }
}