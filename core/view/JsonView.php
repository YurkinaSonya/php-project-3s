<?php

namespace core\view;

use core\http\Response;

class JsonView implements View
{
    public function render(array $params): Response
    {
        $response = new Response(json_encode($params), 200);
        $response->addHeader('Content-Type', 'application/json; charset=UTF-8');
        return $response;
    }

}