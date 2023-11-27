<?php

namespace app\repository;

use app\model\Address;
use core\repository\AbstractRepository;

class AddressRepository extends AbstractRepository
{
    public function findByParentAndQuery(?int $parentId, ?string $query) : array
    {
        if ($parentId === null) {
            $parentId = 0;
        }
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE parent_obj_id = ' . $parentId;
        if ($query != null) {
            $sql .= ' AND text_search LIKE "%' . $query . '%"';
        }
        return array_map(fn($row) => Address::fromArray($row), $this->db->select($sql));
    }

    public function parentsByGuid(string $guid) : array
    {
        $path = str_replace('.', ', ', $this->pathByGuid($guid));
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE obj_id IN ('. $path .') ORDER BY `level`';
        return array_map(fn($row) => Address::fromArray($row), $this->db->select($sql));
    }

    private function pathByGuid(string $guid)
    {
        $sql = 'SELECT path FROM ' . $this->getTableName() . ' WHERE guid = "' . $guid . '"';
        return $this->db->selectColumnOne($sql, 'path');
    }

    public function getByGuid(string $guid) : ?Address
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE guid = "' . $guid . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Address::fromArray($result) : null;
    }

    public function getById(int $id) : ?Address
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $id . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Address::fromArray($result) : null;
    }

    protected function getTableName(): string
    {
        return 'as_objs_tbl';
    }
}