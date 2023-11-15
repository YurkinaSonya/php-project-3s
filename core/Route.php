<?php

namespace core;

use core\http\Request;

class Route
{
    private string $method;

    private string $regexp;

    /** @var callable */
    private $closure;

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

    public function getClosure(): callable
    {
        return $this->closure;
    }

    public function getParam($key)
    {
        return !empty($this->params[$key]) ? $this->params[$key] : null;
    }


}
