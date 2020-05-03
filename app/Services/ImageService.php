<?php

namespace App\Services;

use App\Exceptions\BlogException;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $directory = 'images';

    public function upload($image)
    {
        try {
            $result = Storage::putFileAs($this->directory, $image, generate_filename());
            if ($result) {
                return Storage::url($result);
            }

            throw new BlogException('图片上传失败');
        } catch (\Exception $exception) {
            throw new BlogException('图片上传失败');
        }
    }

    public function delete(string $imgPath): bool
    {
        $imagePath = $this->directory . strrchr($imgPath, '/');

        if (Storage::exists($imagePath)) {
            try {
                return Storage::delete($imagePath);
            } catch (\Exception $exception) {
                throw new BlogException('图片删除失败');
            }
        }

        throw new BlogException('图片删除失败');
    }

    public function directUpload()
    {
        return Storage::signatureConfig(
            $prefix = '/',
            $callBackUrl = '',
            $customData = [],
            $expire = 30
        );
    }
}
