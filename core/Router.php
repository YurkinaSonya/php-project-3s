<?php

namespace core;

use \core\http\Request;
use \core\http\Response;

class Router
{

    /** @var Route[] */
    private array $routes;

    public function addRoute(string $method, string $regexp, callable $closure): Route
    {
        $route = new Route($method, $regexp, $closure);
        $this->routes[] = $route;
        return $route;
    }

    public function execute(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {

                foreach ($route->getMiddlewares() as $middleware) {
                    $middlewareResult = $middleware->handle($route, $request);
                    if ($middlewareResult instanceof Response) {
                        return $middlewareResult;
                    }
                }

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
