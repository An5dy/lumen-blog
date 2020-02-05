<?php

namespace App\Http\Controllers\API\About;

use App\Models\About;
use App\Services\AboutService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\AboutResource;

class ShowAbout extends Controller
{
    public function __invoke(AboutService $aboutService)
    {
        $about = Cache::rememberForever(About::$cacheKey, function () use ($aboutService) {
            return $aboutService->getAbout();
        });

        return (new AboutResource($about))->withMessage('操作成功');
    }
}
