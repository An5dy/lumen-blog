<?php

namespace App\Jobs;

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
        $tops = Scws::sendText($this->article->main)->getTops(10);

        $this->article->tags()->delete();

        foreach ($tops as $top) {
            $this->article->tags()->create(['title' => $top['word']]);
        }
    }
}
