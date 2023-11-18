<?php

namespace core\types;

class DateTimeJsonable extends \DateTime implements \JsonSerializable
{

    public function jsonSerialize(): string
    {
        return $this->format(self::ATOM);
    }
}