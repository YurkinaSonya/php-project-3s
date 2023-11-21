<?php

namespace core\repository;

use core\model\AbstractModel;
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
    protected function getModelDbComplexFields() : array {
        return [];
    }

    protected function arrayToModel(?array $array) : ?AbstractModel
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
        $complexFields = $this->getModelDbComplexFields();
        if (array_key_exists($field, $complexFields)) {
            try {
                $valueClassName = $complexFields[$field];
                return new $valueClassName($dbValue);
            }
            catch (\Exception $exception) {
                return null;
            }
        }
        return $dbValue;
    }

    protected function generateUuid(): string
    {
        $data = openssl_random_pseudo_bytes(16, $strong);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}