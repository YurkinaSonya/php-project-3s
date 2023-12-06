<?php

namespace app\repository;

use app\model\Like;
use core\repository\AbstractRepository;

class LikeRepository extends AbstractRepository
{
    public function addLike(Like $like) : string
    {
        $like->setCreateTime(new \DateTime());
        $this->save($like);
        return $like->getId();
    }

    public function removeLike(Like $like) : void
    {
        $like ->setDeleteTime(new \DateTime());
        $this->save($like);
    }

    public function getLike(string $userId, string $postId) :? Like
    {
        $sql = 'SELECT * FROM `' . $this->getTableName() . '` WHERE user_id = "' . $this->db->escape($userId) . '" and  post_id = "' . $this->db->escape($postId) . '" and delete_time IS NULL';
        $result = $this->db->selectOne($sql);
        return $result ? Like::fromArray($result) : null;
    }

    public function checkHasLike(string $userId, string $postId) : bool
    {
        $sql = 'SELECT COUNT(*) as cnt FROM `' . $this->getTableName() . '` WHERE user_id = "' . $this->db->escape($userId) . '" AND post_id = "' . $this->db->escape($postId) . '"';
        return $this->db->selectColumnOne($sql, 'cnt');
    }

    protected function getTableName(): string
    {
        return 'like';
    }
}