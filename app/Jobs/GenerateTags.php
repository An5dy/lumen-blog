<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Facades\Scws;
use App\Models\Article;

class GenerateTags extends Job
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle()
    {
        $tops = Scws::sendText($this->article->main)->getTops(3);

        $data = [];
        foreach ($tops as $top) {
            $data[] = Tag::query()->firstOrCreate(['title' => $top['word']])->id;
        }

        $this->article->tags()->sync($data);
    }
}
