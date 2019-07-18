<?php

namespace App\Extensions\TNTSearch\Tokenizers;

class ScwsTokenizer extends Tokenizers
{
    protected $scws;

    public function __construct()
    {
        $this->scws = app('scws');
    }

    /**
     * @use      [获取分词]
     * @Author   ze  <846562014@qq.com>
     * @date     2019-07-17 11:04
     * @param string $text
     * @return array
     */
    public function getTokens(string $text): array
    {
        $this->scws->sendText($text);
        $tokens = [];
        while ($result = $this->scws->getResult()) {
            $tokens = array_merge($tokens, array_column($result, 'word'));
        }

        return $tokens;
    }

    public function getScws()
    {
        return $this->scws;
    }
}