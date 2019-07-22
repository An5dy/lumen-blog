<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Article;
use App\Http\Resources\ArchiveCollection;

class ArchivesController extends Controller
{
    public function index()
    {
        $archives = Article::query()
            ->orderByDesc('created_at')
            ->get(['id', 'title', 'created_at'])
            ->each(function ($archive) {
                $archive->mark = Carbon::parse($archive->created_at)->format('M, Y');
            })
            ->groupBy('mark');

        return (new ArchiveCollection($archives))->withMessage('归档获取成功');
    }
}
