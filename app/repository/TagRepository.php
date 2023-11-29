<?php

namespace app\repository;

use app\model\Tag;
use core\repository\AbstractRepository;

class TagRepository extends AbstractRepository
{
    public function getList(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY name ASC';
        //var_export($this->db->select($sql)); die;
        return array_map(fn($row) => Tag::fromArray($row), $this->db->select($sql));
    }
    protected function getTableName(): string
    {
        return 'tag';
    }
}