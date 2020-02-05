<?php

namespace App\Http\Controllers\API\Archive;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArchiveCollection;

class IndexArchive extends Controller
{
    public function __invoke()
    {
        $archives = Article::getArchives();

        return (new ArchiveCollection($archives))->withMessage('归档获取成功');
    }
}
