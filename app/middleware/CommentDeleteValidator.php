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
            $this->errors[] = sprintf('comment with "%s" id does not exist', $commentId);
        }
        if ($this->checkPermsOnComment($commentId)) {
            return;
        }
    }
}