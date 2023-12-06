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
            return;
        }
    }
}