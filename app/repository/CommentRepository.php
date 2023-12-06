<?php

namespace app\repository;

use app\model\Comment;
use core\repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{
    public function createComment(Comment $comment) : string
    {
        $comment->setCreateTime(new \DateTime());
        $this->save($comment);
        return $comment->getId();
    }

    public function updateComment(Comment $comment) : string
    {
        $comment->setModifiedTime(new \DateTime());
        $this->save($comment);
        return $comment->getId();
    }

    public function deleteComment(Comment $comment) : string
    {
        $comment->setDeleteTime(new \DateTime());
        $this->save($comment);
        return $comment->getId();
    }

    public function getComment(string $id) : ?Comment
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $this->db->escape($id) . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Comment::fromArray($result) : null;
    }

    public function getCommentsOfPost(string $postId) : array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE post_id = "' . $this->db->escape($postId) . '" AND parent_id IS NULL';
        return array_map(fn($row) => Comment::fromArray($row), $this->db->select($sql));
    }

    public function getSubCommentsCount(string $id) : int
    {
        $sql = 'SELECT sub_comments FROM comment_childs WHERE comment_id = "' . $this->db->escape($id) . '"';
        return (int)$this->db->selectColumnOne($sql, 'sub_comments');
    }

    public function getChildren(string $parentId) : array
    {
        $sql = 'SELECT * FROM comment WHERE parent_id = "' . $this->db->escape($parentId) . '" ORDER BY create_time Asc';
        return array_map(fn($row) => Comment::fromArray($row), $this->db->select($sql));
    }

    public function getParent(string $id) : ?string
    {
        $sql = 'SELECT parent_id FROM comment WHERE id = "' . $this->db->escape($id) . '"';
        return $this->db->selectColumnOne($sql, 'parent_id');
    }

    public function getAuthorId(string $commentId) : ?string
    {
        $sql = 'SELECT author_id FROM comment WHERE id = "' . $this->db->escape($commentId) . '"';
        return $this->db->selectColumnOne($sql, 'author_id');
    }

    protected function getTableName(): string
    {
        return 'comment';
    }
}