<?php

namespace App\Extensions\Scws;

use Illuminate\Support\Str;

class Scws
{
    protected $scws;

    public function __construct(array $config)
    {
        $this->init($config);
    }

    /**
     * @use      [设置分词文本]
     * @Author   ze <846562014@qq.com>
     * @date     2019-06-21 16:57
     * @param string $text
     * @return $this
     */
    public function sendText(string $text): self
    {
        $this->scws->{Str::snake(__FUNCTION__)}($text);

        return $this;
    }

    /**
     * @use      [获取高频词]
     * @Author   ze <846562014@qq.com>
     * @date     2019-07-01 15:02
     * @param int $tops
     * @return array
     */
    public function getTops(int $tops): array
    {
        return $this->scws->{Str::snake(__FUNCTION__)}($tops);
    }

    protected function init(array $config)
    {
        $this->scws = scws_new();
        foreach ($config as $key => $value) {
            $this->scws->{'set_' . $key}($value);
        }
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([
            $this->scws,
            Str::snake($name),
        ], $arguments);
    }
}