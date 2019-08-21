<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlogException extends HttpException
{
    public function __construct(string $message = '操作失败', int $statusCode = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($statusCode, $message);
    }
}