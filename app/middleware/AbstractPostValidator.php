<?php

namespace app\middleware;

use app\repository\AdministratorRepository;
use app\repository\CommunityRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\service\AccessService;
use app\service\TokenService;
use core\http\Response;
use core\middleware\Validator;

abstract class AbstractPostValidator extends Validator
{
    protected PostRepository $postRepository;
    protected CommunityRepository $communityRepository;

    protected TokenService $tokenService;
    protected AccessService $accessService;
    protected int $statusCode = 400;

    /**
     * @param PostRepository $postRepository
     * @param CommunityRepository $communityRepository
     * @param TokenService $tokenService
     * @param AccessService $accessService
     */
    public function __construct(PostRepository $postRepository, CommunityRepository $communityRepository,TokenService $tokenService, AccessService $accessService)
    {
        $this->postRepository = $postRepository;
        $this->communityRepository = $communityRepository;
        $this->tokenService = $tokenService;
        $this->accessService = $accessService;
    }

    protected function checkPostExists(string $id) : bool
    {
        if ($this->postRepository->getPost($id) === null) {
            $this->errors[] = sprintf('post with %s id does not exist', $id);
            $this->statusCode = 404;
            return false;
        }
        return true;
    }

    protected function checkPermissions(?string $communityId, ?string $userId) : bool
    {
        if ($communityId === null) {
            return true;
        }
        if (!$this->communityRepository->checkCommunityIsClosed($communityId)) {
            return true;
        }
        if ($userId === null) {
            $this->errors[] = sprintf('user have not permissions to post in community with "%s" id', $communityId);
            $this->statusCode = 403;
            return false;
        }
        if (in_array($communityId, $this->accessService->getMyCommunityIds($userId))) {
            $this->errors[] = sprintf('user have not permissions to post in community with "%s" id', $communityId);
            $this->statusCode = 403;
            return false;
        }
        return true;
    }

    protected function abstractValidate(?string $postId) : void
    {
        $userId = $this->tokenService->getCurrentUserId();
        if (!$this->checkPostExists($postId)) {
            return;
        }
        if (!$this->checkPermissions($this->postRepository->getCommunityIdByPostId($postId), $userId)) {
            $this->errors[] = sprintf('post with %s id is unavailable', $postId);
            $this->statusCode = 403;
            return;
        }
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), $this->statusCode);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}