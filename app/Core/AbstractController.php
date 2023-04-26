<?php

declare(strict_types=1);

namespace Core;

abstract class AbstractController
{
    public static function __callStatic(string $name, array $arguments)
    {
        (new Error(404))->getResponse();
        exit();
    }
}