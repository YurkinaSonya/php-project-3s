<?php

namespace app\middleware;

use app\repository\TokenRepository;
use app\service\TokenService;
use core\http\Request;
use core\http\Response;
use core\middleware\Middleware;
use core\Route;

class TokenMiddleware implements Middleware
{
    private TokenService $service;

    /**
     * @param TokenService $service
     */
    public function __construct(TokenService $service)
    {
        $this->service = $service;
    }


    public function handle(Route $route, Request $request): Response|null
    {
        if ($this->service->checkValid()) {
            return null;
        }
        return new Response('Access denied', 401);
    }
}