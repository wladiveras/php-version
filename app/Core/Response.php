<?php

namespace App\Core;

class Response
{
    private int $statusCode;
    private string $body;

    public function __construct(int $statusCode, string $body)
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        echo $this->body;
    }
}
