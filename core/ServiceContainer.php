<?php

namespace core;

use ArrayAccess;
use InvalidArgumentException;

class ServiceContainer implements ArrayAccess
{
    protected array $services = array();

    public function __construct(array $values = array())
    {
        $this->services = $values;
    }

    public function offsetSet($offset, $value): void
    {
        $this->services[$offset] = $value;
    }

    public function offsetGet($offset): mixed
    {
        if (!array_key_exists($offset, $this->services)) {
            throw new InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $offset));
        }

        $isFactory = is_object($this->services[$offset]) && method_exists($this->services[$offset], '__invoke');

        return $isFactory ? $this->services[$offset]($this) : $this->services[$offset];
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->services);
    }

    public function offsetUnset($offset): void
    {
        unset($this->services[$offset]);
    }

    public static function share(callable $callable): callable
    {
        if (!is_object($callable) || !method_exists($callable, '__invoke')) {
            throw new InvalidArgumentException('Service definition is not a Closure or invokable object.');
        }

        return static function ($c) use ($callable) {
            static $object;

            if ($object === null) {
                $object = $callable($c);
            }

            return $object;
        };
    }

}
