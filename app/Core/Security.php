<?php

declare(strict_types = 1);

namespace Core;

class Security
{
    public static function is_garnted(string $role): void
    {
        if (filter_input_fix(INPUT_SERVER, 'HTTP_ROLE') != $role) {
            (new Error(401))->getResponse();
        }
    }
}