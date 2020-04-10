<?php

namespace App\Http\Controllers\API\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchiveCollection;
use App\Models\Article;

class IndexArchive extends Controller
{
    public function __invoke()
    {
        $archives = Article::getArchives();

        return (new ArchiveCollection($archives))->withMessage('归档获取成功');
    }
}
