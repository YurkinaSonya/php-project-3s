<?php

namespace app\middleware;

use app\middleware\AddLikeValidator;
use app\repository\AdministratorRepository;
use app\repository\CommunityRepository;
use app\repository\LikeRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Request;
use core\Route;

class RemoveLikeValidator extends GetPostValidator
{
    private LikeRepository $likeRepository;
    public function __construct(PostRepository $postRepository, CommunityRepository $communityRepository,TokenService $tokenService, AccessService $accessService,LikeRepository $likeRepository)
    {
        parent::__construct($postRepository, $communityRepository, $tokenService, $accessService);
        $this->likeRepository = $likeRepository;
    }
    protected function validate(Route $route, Request $request): void
    {
        parent::validate($route, $request);
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        if (!$this->checkHasAlreadyLike($postId, $userId)) {
            $this->errors[] = sprintf('post with "%s" id was not liked by user with "%s" id', $postId, $userId);
            $this->statusCode = 400;
            return;
        }
    }

    private function checkHasAlreadyLike(string $postId, string $userId) : bool
    {
        return !($this->likeRepository->getLike($userId, $postId) === null);
    }

}