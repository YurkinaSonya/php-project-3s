<?php

namespace app\middleware;

use app\middleware\AbstractCommentValidator;
use core\http\Request;
use core\Route;

class CommentUpdateValidator extends AbstractCommentValidator
{
    protected function validate(Route $route, Request $request): void
    {
        $body = $request->getBodyJson();
        $this->checkEmpty(['content' => 'content'], $body);
        if ($this->errors) {
            return;
        }
        $commentId = $route->getParam(0);
        if (!$this->checkCommentExists($commentId)) {
            $this->errors[] = sprintf('comment with "%s" id does not exist', $commentId);
        }
        if ($this->checkContent($body['content'])) {
            return;
        }
        if ($this->checkPermsOnComment($commentId)) {
            return;
        }
    }
}