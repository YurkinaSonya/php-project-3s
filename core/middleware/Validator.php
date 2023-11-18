<?php

namespace core\middleware;

use core\http\Request;
use core\http\Response;
use core\Route;

abstract class Validator implements Middleware
{

    protected array $errors = [];


    abstract protected function validate(Route $route, Request $request) : void;

    abstract protected function renderErrors(array $errors): Response;

    public function handle(Route $route, Request $request): Response|null
    {
        $this->validate($route, $request);

        if (empty($this->errors)) {
            return null;
        }

        return $this->renderErrors($this->errors);
    }

    protected function checkEmpty(array $fields, array $data) : void
    {
        foreach ($fields as $field => $fieldTitle) {
            if (array_key_exists($field, $data) && (string)$data[$field] !== '') {
                continue;
            }
            $this->errors[] = sprintf('Mandatory field "%s" is empty', $field);
        }
    }


}