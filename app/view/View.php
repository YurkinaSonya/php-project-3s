<?php

namespace app\view;

interface View
{
    public function render(array $params):string;
}