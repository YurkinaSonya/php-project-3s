<?php

namespace core\repository;

use core\db\Handler;
use core\model\AbstractModel;
use core\types\DateTimeJsonable;

abstract class AbstractRepository
{
    protected Handler $db;

    /**
     * @param Handler $db
     */
    public function __construct(Handler $db)
    {
        $this->db = $db;
    }

    abstract protected function getTableName() : string;


    protected function save(AbstractModel $model) : void
    {
        if($model->getId() !== null) {
            $array = $this->arrayModelToDbFields($model);
            $id = $array['id'];
            unset($array['id']);
            $this->db->update($this->getTableName(), $array, 'id = "' . $id . '"');
        }
        else {
            $model->setId($this->generateUuid());
            $this->db->insert($this->getTableName(), $this->arrayModelToDbFields($model));
        }
    }
    protected function generateUuid(): string
    {
        $data = openssl_random_pseudo_bytes(16, $strong);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    private function arrayModelToDbFields(AbstractModel $model) : array
    {
        $modelValues = $model->toArray();
        //var_export($modelValues);
        $dbFields = $model->outsideGetModelDbFields();
        $dbModelValues = [];
        foreach ($dbFields as $dbField => $field) {
            $dbModelValues[$dbField] = $modelValues[$field];
        }
        return $dbModelValues;
    }
}