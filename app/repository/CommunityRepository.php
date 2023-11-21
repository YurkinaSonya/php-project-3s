<?php

namespace app\repository;

use app\model\Community;
use core\db\Handler;
use core\repository\AbstractRepository;

class CommunityRepository extends AbstractRepository
{
    private Handler $db;

    public function __construct(Handler $db)
    {
        $this->db = $db;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return Community[]
     */
    public function getList(): array
    {
        $sql = 'SELECT * FROM community ORDER BY id ASC';
        return array_map(fn($row) => $this->arrayToModel($row), $this->db->select($sql));
    }

    protected function getModelClass(): string
    {
        return Community::class;
    }

    protected function getModelDbFields(): array
    {
        return ['id', 'create_time', 'name', 'description', 'is_closed', 'subscribers_count'];
    }

    protected function getModelDbComplexFields(): array
    {
        return ['create_time'];
    }


}