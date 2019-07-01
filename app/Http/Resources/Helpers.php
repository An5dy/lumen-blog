<?php

namespace App\Http\Resources;

use Symfony\Component\HttpFoundation\Response;

trait Helpers
{
    protected $message = '操作成功';

    protected $statusCode = Response::HTTP_OK;

    public function with($request): array
    {
        return [
            'message' => $this->message,
            'status_code' => $this->statusCode,
        ];
    }

    public function withMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}