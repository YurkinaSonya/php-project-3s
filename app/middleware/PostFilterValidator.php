<?php

namespace app\middleware;

use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class PostFilterValidator extends Validator
{

    protected function validate(Route $route, Request $request): void
    {
        // TODO: Implement validate() method.
    }

    protected function renderErrors(array $errors): Response
    {
        // TODO: Implement renderErrors() method.
    }
}