<?php

declare(strict_types = 1);

namespace Core;

use Controller\Main;

class Router
{
    public function __construct()
    {
        $uri = filter_input_fix(INPUT_SERVER, "REQUEST_URI");
        $urlPath = parse_url($uri, PHP_URL_PATH);
        $path = explode('/', $urlPath);
        if (count($path) == 4 && $path[1] == 'api') {
            Security::is_garnted('USER');
            header('Content-Type: application/json');
            $domainClass = 'Api\\' . ucfirst($path[2]);
            $functionName = filter_input_fix(INPUT_SERVER, 'REQUEST_METHOD') . lcfirst(
                implode(
                    "",
                    array_map(
                        function ($v) {return ucfirst($v);},
                        explode('-', $path[3])
                    )
                )
            );
            try {
                $domainClass::$functionName();
            } catch (\Exception $exception) {
                (new Error(404))->getResponse();
            }
        }elseif ($urlPath == '/' ){
            Main::main();
        } else {
            (new Error(404))->getResponse();
        }
    }
}