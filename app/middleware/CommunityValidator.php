<?php

namespace app\middleware;

use app\repository\CommunityRepository;
use core\http\Request;
use core\http\Response;
use core\middleware\Validator;
use core\Route;

class CommunityValidator extends Validator
{
    private CommunityRepository $communityRepository;

    /**
     * @param CommunityRepository $communityRepository
     */
    public function __construct(CommunityRepository $communityRepository)
    {
        $this->communityRepository = $communityRepository;
    }


    protected function validate(Route $route, Request $request): void
    {
        $communityId = $route->getParam(0);
        if (!$this->validateCommunityExisting($communityId)) {
            $this->errors[] = 'this community does not exist';
            return;
        }
    }

    protected function renderErrors(array $errors): Response
    {
        $response = new Response(json_encode(['errors' => $errors]), 404);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }

    private function validateCommunityExisting(string $communityId) : bool
    {
        if ($this->communityRepository->getCommunity($communityId) === null) {
            return false;
        }
        return true;
    }
}