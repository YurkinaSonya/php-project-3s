<?php

namespace app\middleware;

use app\repository\CommunityRepository;
use app\repository\SubscribeRepository;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class UnsubscribeValidator extends Validator
{
    private SubscribeRepository $subscribeRepository;
    private TokenService $tokenService;

    /**
     * @param SubscribeRepository $subscribeRepository
     * @param TokenService $tokenService
     */
    public function __construct(SubscribeRepository $subscribeRepository, TokenService $tokenService)
    {
        $this->subscribeRepository = $subscribeRepository;
        $this->tokenService = $tokenService;
    }


    protected function validate(Route $route, Request $request): void
    {
        $communityId = $route->getParam(0);
        $userId = $this->tokenService->getCurrentUserId();
        if (!$this->validateIsAlready($userId, $communityId)) {
            return;
        }
    }

    private function validateIsAlready(string $userId, string $communityId) : bool
    {
        $sub = $this->subscribeRepository->findByUserIdCommunityId($userId, $communityId);
        if ($sub === null) {
            $this->errors[] = 'user is not subscribed on this community';
            return false;
        }
        return true;
    }



    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 400);
        $response->addHeader('Content-Type', 'application/json');
        return $response;

    }
}