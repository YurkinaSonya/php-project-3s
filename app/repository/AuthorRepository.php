<?php

namespace app\repository;

use app\model\Author;
use core\repository\AbstractRepository;

class AuthorRepository extends AbstractRepository
{

    public function getListOfAuthors(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE posts > 0 ORDER BY id ASC';
        return array_map(fn($row) => Author::fromArray($row), $this->db->select($sql));
    }
    protected function getTableName(): string
    {
        return 'author';
    }
}