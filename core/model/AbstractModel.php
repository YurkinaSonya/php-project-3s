<?php

namespace core\model;

abstract class AbstractModel
{
    public function toArray() : array
    {
        return get_object_vars($this);
    }
}