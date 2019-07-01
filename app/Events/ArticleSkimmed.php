<?php

namespace App\Events;

use App\Models\Article;

class ArticleSkimmed extends Event
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }
}
