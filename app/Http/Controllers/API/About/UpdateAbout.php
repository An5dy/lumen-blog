<?php

namespace App\Http\Controllers\API\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Services\AboutService;

class UpdateAbout extends Controller
{
    public function __invoke(AboutService $aboutService, AboutRequest $request)
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
