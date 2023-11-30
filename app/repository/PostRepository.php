<?php

namespace app\repository;

use app\model\Post;
use core\repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    public function getList(int $offset, int $limit) : array
    {
        $sql = 'SELECT * ' . $this->sqlWithTerms() . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        return array_map(fn($row) => Post::fromArray($row), $this->db->select($sql));
    }

    public function getTotalCount() : int
    {
        $sql = 'SELECT COUNT(*) ' . $this->sqlWithTerms();
        return $this->db->selectColumnOne($sql, 'COUNT(*)');
    }

    private function sqlWithTerms() : string
    {
        return ' FROM ' . $this->getTableName() . ' ORDER BY id ASC ';
    }

    protected function getTableName(): string
    {
        return 'post';
    }
}