<?php

namespace core\repository;

use core\types\DateTimeJsonable;

abstract class AbstractRepository
{

    abstract protected function getModelClass() : string;

    /**
     * @return string[]
     */
    abstract protected function getModelDbFields() : array;

    /**
     * @return string[]
     */
    protected function getModelDbDateFields() : array {
        return [];
    }

    protected function arrayToModel(?array $array) : ?\AbstractModel
    {
        if ($array === null) {
            return null;
        }

        $modelClassName = $this->getModelClass();
        $modelFields = $this->getModelDbFields();

        foreach ($modelFields as $key) {
            if (!array_key_exists($key, $array)) {
                return null;
            }
        }

        return new $modelClassName(...array_map(fn(string $field)=>$this->convertFieldValue($field, $array[$field]), $modelFields));
    }

    protected function convertFieldValue(string $field, mixed $dbValue) : mixed
    {
        if (in_array($field, $this->getModelDbDateFields())) {
            try {
                return new DateTimeJsonable($dbValue);
            }
            catch (\Exception $exception) {
                return null;
            }
        }
        return $dbValue;
    }
}