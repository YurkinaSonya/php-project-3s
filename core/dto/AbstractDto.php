<?php

namespace core\dto;

abstract class AbstractDto
{
    public function toArray() : array
    {
        return get_object_vars($this);
    }
}