<?php

namespace app\repository;

use app\model\Community;
use core\repository\AbstractRepository;

class CommunityRepository extends AbstractRepository
{
    public function getListOfCommunity(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY id ASC';
        return array_map(fn($row) => Community::fromArray($row), $this->db->select($sql));
    }
    public function getCommunity(string $id) : ?Community
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $id . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Community::fromArray($result) : null;
    }

    public function checkCommunityIsClosed(string $id) : bool
    {
        $sql = 'SELECT is_closed FROM ' . $this->getTableName() . ' WHERE id = "' . $id . '"';
        return (bool)$this->db->selectColumnOne($sql, 'is_closed');
    }

    protected function getTableName(): string
    {
        return 'community';
    }
}