<?php

namespace App\Exceptions;

use Dingo\Api\Exception\Handler;
use Dingo\Api\Exception\RateLimitExceededException;
use Exception;

class DingoHandler extends Handler
{
    public function handle(Exception $exception)
    {
        // 重写访问接口限速异常
        if ($exception instanceof RateLimitExceededException) {
            $this->setReplacements([
                ':message' => trans('auth.api_throttle', ['seconds' => $exception->getHeaders()['Retry-After']]),
            ]);
        }

        return parent::handle($exception);
    }
}
