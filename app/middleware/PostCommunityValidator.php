<?php

namespace app\middleware;

use core\http\Request;
use core\Route;

class PostCommunityValidator extends AbstractPostValidator
{
    protected function validate(Route $route, Request $request): void
    {
        $communityId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        if (!$this->checkPermissions($communityId, $userId)) {
            $this->errors[] = sprintf('user have not permissions to post in community with "%s" id', $communityId);
            $this->statusCode = 403;
            return;
        }
    }
}