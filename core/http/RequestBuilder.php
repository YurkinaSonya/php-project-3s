<?php

namespace core\http;

class RequestBuilder
{

    public function createFromGlobals(): Request
    {
        return new Request(
            function_exists('getallheaders') ? getallheaders() : [],
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            array_merge($_GET, $_POST),
            file_get_contents('php://input')
        );
    }
    
}
