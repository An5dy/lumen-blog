<?php

namespace App\Extensions\TNTSearch\Tokenizers;

use TeamTNT\TNTSearch\Support\TokenizerInterface;

abstract class Tokenizers implements TokenizerInterface
{
    public function tokenize($text, $stopwords = []): array
    {
        $tokens = $this->getTokens($text);
        $tokens = array_filter($tokens, 'trim');// 去除左右空格

        return array_diff($tokens, $this->getStopWords($stopwords));// 禁止词语
    }

    protected function getStopWords($stopwords)
    {
        return empty($stopwords) ? config('scout.tntsearch.stopwords') : $stopwords;
    }

    abstract protected function getTokens(string $text);
}