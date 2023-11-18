<?php

namespace app\view;

use core\http\Response;

interface View
{
    public function render(array $params): string|Response;
}