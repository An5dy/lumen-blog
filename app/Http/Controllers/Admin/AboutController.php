<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Services\AboutService;
use App\Http\Requests\AboutRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
{
    public function index(AboutService $aboutService)
    {
        $about = $aboutService->getAbout();

        return (new AboutResource($about))->withMessage('操作成功');
    }

    public function updateOrCreate(AboutService $aboutService, AboutRequest $request)
    {
        $about = $aboutService->getAbout();

        $data = ['main' => $request->main];
        if (empty($about)) {
            About::query()->create($data);
        } else {
            $about->update($data);
        }

        return $this->response->noContent();
    }
}