<?php

namespace App\Http\Controllers;

use App\Services\AboutService;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
{
    public function index(AboutService $aboutService)
    {
        $about = $aboutService->getAbout();

        return (new AboutResource($about))->withMessage('操作成功');
    }
}