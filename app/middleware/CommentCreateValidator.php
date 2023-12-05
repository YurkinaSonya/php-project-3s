<?php

namespace app\middleware;

use app\middleware\AbstractCommentValidator;
use core\http\Request;
use core\http\Response;
use core\Route;

class CommentCreateValidator extends AbstractCommentValidator
{
    protected function validate(Route $route, Request $request): void
    {
        $body = $request->getBodyJson();
        $this->checkEmpty(['content' => 'content'], $body);
        if ($this->errors) {
            $this->statusCode = 400;
            return;
        }
        if ($this->checkContent($body['content'])) {
            return;
        }
        if ($body['parentId'] !== null and !$this->checkParentExists($body['parentId'])) {
            return;
        }
    }
}