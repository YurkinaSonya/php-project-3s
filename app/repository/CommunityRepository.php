<?php

namespace app\repository;

use app\model\Community;
use core\db\Handler;
use core\model\AbstractModel;
use core\repository\AbstractRepository;

class CommunityRepository extends AbstractRepository
{

    /**
     * @param int $offset
     * @param int $limit
     * @return Community[]
     */
    public function getList(): array
    {
        $sql = 'SELECT * FROM community ORDER BY id ASC';
        return array_map(fn($row) => Community::fromArray($row), $this->db->select($sql));
    }


    protected function getTableName(): string
    {
        return 'community';
    }
}