<?php

namespace app\middleware;

use app\repository\AdministratorRepository;
use app\repository\CommunityRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class GetPostValidator extends AbstractPostValidator
{
    protected function validate(Route $route, Request $request): void
    {
        $postId = $route->getParam(0);
        $this->abstractValidate($postId);
    }
}