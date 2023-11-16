<?php

namespace core;

use core\http\Request;
use core\middleware\Middleware;

class Route
{
    private string $method;

    private string $regexp;

    /** @var callable */
    private $closure;

    /** @var Middleware[] */
    private array $middlewares = [];

    /** @var array */
    private array $params;

    /**
     * @param $method
     * @param $regexp
     * @param $closure
     */
    public function __construct($method, $regexp, $closure)
    {
        $this->method  = strtoupper($method);
        $this->regexp  = $regexp;
        $this->closure = $closure;
    }

    public function match(Request $request): bool
    {
        if ($request->getMethod() !== $this->method) {
            return false;
        }

        $regExp = '|^' . $this->regexp . '$|u';
        if (!preg_match($regExp, rtrim($request->getUrl(), '/'), $matches)) {
            return false;
        }
        unset($matches[0]);
        $this->params = array_values($matches);

        return true;
    }

    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function addMiddleware(Middleware $middleware): Route
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function getClosure(): callable
    {
        return $this->closure;
    }

    public function getParam($key)
    {
        return !empty($this->params[$key]) ? $this->params[$key] : null;
    }


}
