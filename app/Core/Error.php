<?php

declare(strict_types=1);

namespace Core;

class Error
{
    public function __construct(
        private readonly int    $code,
        private readonly string $message = ''
    )
    {
    }

    public function getResponse(): void
    {
        switch ($this->code) {
            case 400:
                header("HTTP/1.1 400 Bad Request");
                echo $this->message;
                break;
            case 401:
                header("HTTP/1.1 403 Forbidden");
                echo 'Access denied';
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                echo 'NOT FOUND';
                break;
        }

        exit;
    }
}