<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Admin\UploadImageResource;

class ImagesController extends Controller
{
    protected $directory = 'images';

    public function store(ImageRequest $request)
    {
        $result = Storage::putFileAs($this->directory, $request->image, generate_filename());

        if ($result) {
            $path = Storage::url($result);

            return (new UploadImageResource(compact('path')))->withMessage('图片上传成功');
        }

        return $this->response->errorBadRequest('图片上传失败');
    }

    public function destroy(ImageRequest $request)
    {
        $imagePath = $this->directory . strrchr($request->img_path, '/');
        if (Storage::exists($imagePath)) {
            try {
                if (Storage::delete($imagePath)) {
                    return $this->response->noContent();
                } else {
                    return $this->response->errorBadRequest('图片删除失败');
                }
            } catch (\Exception $exception) {
                return $this->response->errorBadRequest('图片删除失败');
            }
        }

        return $this->response->errorBadRequest('图片删除失败');
    }
}
