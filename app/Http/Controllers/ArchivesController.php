<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Article;
use App\Http\Resources\ArchiveCollection;

class ArchivesController extends Controller
{
    public function index()
    {
        $archives = Article::getArchives();

        return (new ArchiveCollection($archives))->withMessage('归档获取成功');
    }
}
