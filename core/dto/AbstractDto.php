<?php

namespace core\dto;

use Cassandra\Date;

abstract class AbstractDto
{
    abstract protected static function getDtoTypes(): array;

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromArray(array $array): static
    {
        $array = static::convertTypesOfArray($array);
        return new static(...$array);
    }

    protected static function convertTypesOfArray(array $array): array
    {
        $typesArray = static::getDtoTypes();
        foreach ($array as $key => &$value) {
            if (!array_key_exists($key, $typesArray)) {
                continue;
            }
            $type = $typesArray[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format(\DateTime::ATOM);
            }
            $value = new $type($value);
        }
        return $array;
    }
}