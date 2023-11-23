<?php

namespace app\service;

use app\model\Token;
use app\repository\TokenRepository;
use core\http\Request;

class TokenService
{
    private TokenRepository $tokenRepository;
    private Request $request;

    /**
     * @param TokenRepository $tokenRepository
     * @param Request $request
     */
    public function __construct(TokenRepository $tokenRepository, Request $request)
    {
        $this->tokenRepository = $tokenRepository;
        $this->request = $request;
    }


    public function checkValid() : bool
    {
        return $this->getCurrentToken() !== null;

    }

    public function getCurrentUserId() : ?string
    {
        $token = $this->getCurrentTokenValue();
        if ($token === null) {
            return null;
        }
        $tokenModel = $this->getCurrentToken();
        if ($tokenModel === null) {
            return null;
        }
        return $tokenModel->getUserId();
    }

    private function getCurrentToken() : ?Token
    {
        $tokenModel = $this->tokenRepository->findByToken($this->getCurrentTokenValue());
        if ($tokenModel === null) {
            return null;
        }
        return $tokenModel;
    }

    private function getCurrentTokenValue() : ?string
    {
        $header = $this->request->getHeader('Authorization');
        if ($header === null) {
            return null;
        }
        $tokenParts = explode(' ', $header);
        if (count($tokenParts) === 1) {
            return $tokenParts[0];
        }
        return $tokenParts[1];

    }

    public function createToken(string $userId) : string
    {
        $token = bin2hex(random_bytes(16));
        $this->tokenRepository->createToken($userId, $token);
        return $token;
    }

    public function logoutUser(string $userId) : string
    {

    }

}