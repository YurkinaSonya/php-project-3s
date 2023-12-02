<?php

namespace app\middleware;

use app\repository\AdministratorRepository;
use app\repository\CommunityRepository;
use app\repository\PostRepository;
use app\repository\SubscribeRepository;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class GetPostValidator extends Validator
{
    protected PostRepository $postRepository;
    protected CommunityRepository $communityRepository;
    protected SubscribeRepository$subscribeRepository;
    protected AdministratorRepository $administratorRepository;
    protected TokenService $tokenService;
    protected int $statusCode = 400;

    /**
     * @param PostRepository $postRepository
     * @param CommunityRepository $communityRepository
     * @param SubscribeRepository $subscribeRepository
     * @param AdministratorRepository $administratorRepository
     * @param TokenService $tokenService
     */
    public function __construct(PostRepository $postRepository, CommunityRepository $communityRepository, SubscribeRepository $subscribeRepository, AdministratorRepository $administratorRepository, TokenService $tokenService)
    {
        $this->postRepository = $postRepository;
        $this->communityRepository = $communityRepository;
        $this->subscribeRepository = $subscribeRepository;
        $this->administratorRepository = $administratorRepository;
        $this->tokenService = $tokenService;
    }


    protected function validate(Route $route, Request $request): void
    {
        $postId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        if (!$this->checkPostExists($postId)) {
            $this->errors[] = sprintf('post with %s id does not exist', $postId);
            $this->statusCode = 404;
            return;
        }
        if (!$this->checkPermissions($this->postRepository->getCommunityOFPost($postId), $userId)) {
            $this->errors[] = sprintf('post with %s id is unavailable', $postId);
            $this->statusCode = 404;
            return;
        }
        

    }

    protected function checkPostExists(string $id) : bool
    {
        return $this->postRepository->getPost($id) !== null;
    }

    protected function checkPermissions(string $communityId, ?string $userId) : bool
    {
        if ($this->communityRepository->checkCommunityIsClosed($communityId)) {
            if ($userId !== null) {
                $subscribes = $this->subscribeRepository->getSubscribesOfUser($userId);
                $admins = $this->administratorRepository->getAdminRolesOfUser($userId);
                if(in_array($communityId, array_merge($subscribes, $admins))) {
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), $this->statusCode);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}