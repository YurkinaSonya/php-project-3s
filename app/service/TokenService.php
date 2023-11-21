<?php

namespace app\service;

use app\repository\TokenRepository;

class TokenService
{
    private TokenRepository $tokenRepository;

    /**
     * @param TokenRepository $tokenRepository
     */
    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function checkValid(string $token) : bool
    {

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