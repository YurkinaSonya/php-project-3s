<?php

namespace app\middleware;

use app\middleware\AbstractCommentValidator;
use core\http\Request;
use core\Route;

class CommentDeleteValidator extends AbstractCommentValidator
{
    protected function validate(Route $route, Request $request): void
    {
        $commentId = $route->getParam(0);
        if (!$this->checkCommentExists($commentId)) {
            return;
        }
        if ($this->checkPermsOnComment($commentId)) {
            return;
        }
    }
}