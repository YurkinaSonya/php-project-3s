<?php

namespace core;

use \core\http\Request;
use \core\http\Response;

class Router
{

    /** @var Route[] */
    private array $routes;

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function execute(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                $closure = $route->getClosure();
                $responseBody = $closure($route, $request);
                if ($responseBody instanceof Response) {
                    return $responseBody;
                }
                return new Response(
                    $responseBody,
                    200
                );
            }
        }
        return new Response('', 404);
    }

}
