<?php

namespace app\repository;

use core\repository\AbstractRepository;

class LikeRepository extends AbstractRepository
{
    public function checkHasLike(string $userId, string $postId) : bool
    {
        $sql = 'SELECT COUNT(*) as cnt FROM `' . $this->getTableName() . '` WHERE user_id = "' . $userId . '" AND post_id = "' . $postId . '"';
        return $this->db->selectColumnOne($sql, 'cnt');
    }

    protected function getTableName(): string
    {
        return 'like';
    }
}