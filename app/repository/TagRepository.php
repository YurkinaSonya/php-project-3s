<?php

namespace app\repository;

use app\model\Tag;
use core\repository\AbstractRepository;

class TagRepository extends AbstractRepository
{
    public function getList(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY name ASC';
        //var_export($this->db->select($sql)); die;
        return array_map(fn($row) => Tag::fromArray($row), $this->db->select($sql));
    }

    public function getPostTags(string $postId) : array
    {
        $sql = 'SELECT id, `name`, create_time
                FROM post_tags 
                JOIN tag ON post_tags.tag_id = tag.id
                WHERE post_id = "' . $postId . '"';
        return array_map(fn($row) => Tag::fromArray($row), $this->db->select($sql));
    }
    protected function getTableName(): string
    {
        return 'tag';
    }
}