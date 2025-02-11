<?php

namespace app\repository;

use app\model\Tag;
use core\repository\AbstractRepository;

class TagRepository extends AbstractRepository
{
    public function setTagForPost(string $postId, string $tagId) : void
    {
        $values = [];
        $values['post_id'] = $postId;
        $values['tag_id'] = $tagId;
        $this->db->insert('post_tags', $values);
    }

    public function getList(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY name ASC';
        return array_map(fn($row) => Tag::fromArray($row), $this->db->select($sql));
    }

    public function getPostTags(string $postId) : array
    {
        $sql = 'SELECT id, `name`, create_time
                FROM post_tags 
                JOIN tag ON post_tags.tag_id = tag.id
                WHERE post_id = "' . $this->db->escape($postId) . '"';
        return array_map(fn($row) => Tag::fromArray($row), $this->db->select($sql));
    }

    public function getTagById(string $id) : ?Tag
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $this->db->escape($id) . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Tag::fromArray($result) : null;
    }
    protected function getTableName(): string
    {
        return 'tag';
    }
}