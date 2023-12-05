<?php

namespace app\middleware;

use app\middleware\AbstractPostValidator;
use app\repository\AdministratorRepository;
use app\repository\CommentRepository;
use app\repository\CommunityRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Request;
use core\Route;

class CommentPostValidator extends AbstractPostValidator
{
    protected CommentRepository $commentRepository;

    /**
     * @param CommentRepository $commentRepository
     */
    public function __construct(PostRepository $postRepository, CommunityRepository $communityRepository,TokenService $tokenService, AccessService $accessService, CommentRepository $commentRepository)
    {
        parent::__construct($postRepository, $communityRepository, $tokenService, $accessService);
        $this->commentRepository = $commentRepository;
    }


    protected function validate(Route $route, Request $request): void
    {
        $commentId = $route->getParam(0);
        $postId = $this->commentRepository->getComment($commentId)->getPostId();
        $this->abstractValidate($postId);
    }
}