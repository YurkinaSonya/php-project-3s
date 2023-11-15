<?php

namespace app\view;

class JsonView implements View
{
    public function render(array $params): string
    {
        return json_encode($params);
    }

}