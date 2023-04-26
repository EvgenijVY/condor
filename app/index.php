<?php

declare(strict_types=1);

spl_autoload_register('classAutoloader');
function classAutoloader(string $className) {
    $fileName = str_replace('\\', '/', $className) . '.php';
    if (file_exists($fileName)) {
        require_once ($fileName);
    } else {
        (new \Core\Error(404))->getResponse();
        exit();
    }
}

//for FastCGI fix
function filter_input_fix(int $input, string $name, int $filter = FILTER_DEFAULT): mixed {
    return match ($input) {
        INPUT_SERVER => filter_var($_SERVER[$name] ?? null, $filter),
        INPUT_GET => filter_var($_GET[$name] ?? null, $filter),
        INPUT_POST => filter_var($_POST[$name] ?? null, $filter),
        default => null
    };
}

//load config
require_once 'config.php';

new \Core\Router();