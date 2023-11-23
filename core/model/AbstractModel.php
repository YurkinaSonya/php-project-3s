<?php

namespace core\model;

abstract class AbstractModel
{
    abstract public function getId() : ?string;
    abstract public function setId(string $id) : void;

    public function outsideGetModelDbFields() : array
    {
        return static::getModelDbFields();
    }

    /**
     * @return string[]
     */
    abstract static public function getModelDbFields() : array;

    abstract static protected function getModelDoubleFieldExample() : ?string;

    /**
     * @return string[]
     */
    protected static function getModelDbComplexFields() : array {
        return [];
    }
    public function toArray() : array
    {
        return get_object_vars($this);
    }
    public static function fromArray(?array $array) : ?AbstractModel
    {
        if ($array === null) {
            return null;
        }

        $modelClassName = static::class;
        $modelFields = static::getModelDbFields();
        $doubleNameExample = static::getModelDoubleFieldExample();
        if ($doubleNameExample !== null) {
            if (array_key_exists($doubleNameExample, $array)) {
                //var_export($array);
                foreach ($modelFields as $keyBd => $key) {
                    if (!array_key_exists($keyBd, $array)) {
                        $array[$keyBd] = null;
                    }
                }
                $modelValues = [];
                foreach ($modelFields as $dbField => $field) {
                    $modelValues[$field] = static::convertFieldValue($dbField, $array[$dbField]);
                }
                return new $modelClassName(...$modelValues);
            }
        }
        foreach ($modelFields as $keyBd => $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = null;
            }
        }
        $modelValues = [];
        foreach ($modelFields as $dbField => $field) {
            $modelValues[$field] = static::convertFieldValue($dbField, $array[$field]);
        }

        return new $modelClassName(...$modelValues);
    }

    protected static function convertFieldValue(string $field, mixed $dbValue) : mixed
    {
        $complexFields = static::getModelDbComplexFields();
        if (array_key_exists($field, $complexFields)) {
            try {
                $valueClassName = $complexFields[$field];

                if ($dbValue instanceof \DateTime) {
                    $dbValue = $dbValue->format('Y-m-d H:i:s');
                }
                return new $valueClassName($dbValue);
            }
            catch (\Exception $exception) {
                return null;
            }
        }
        return $dbValue;
    }


}