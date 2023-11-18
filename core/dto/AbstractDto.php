<?php

namespace core\dto;

class AbstractDto
{
    public function toArray() : array
    {
        return get_object_vars($this);
    }
}