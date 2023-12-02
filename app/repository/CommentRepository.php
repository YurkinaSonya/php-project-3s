<?php

namespace app\repository;

use app\model\Comment;
use core\repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{
    public function getComment(string $id) : ?Comment
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $id . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Comment::fromArray($result) : null;
    }

    public function getCommentsOfPost(string $postId) : array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE post_id = "' . $postId . '" AND parent_id IS NULL';
        return array_map(fn($row) => Comment::fromArray($row), $this->db->select($sql));
    }

    public function getSubComments(string $id) : int
    {
        $sql = 'SELECT sub_comments FROM comment_childs WHERE comment_id = "' . $id . '"';
        return intval($this->db->selectColumnOne($sql, 'sub_comments'));
    }

    public function getChildren(string $parentId) : array
    {
        $sql = 'SELECT * FROM comment WHERE parent_id = "' . $parentId . '" ORDER BY create_time Asc';
        return array_map(fn($row) => Comment::fromArray($row), $this->db->select($sql));
    }

    protected function getTableName(): string
    {
        return 'comment';
    }
}