<?php

namespace app\repository;

use app\model\Author;
use core\repository\AbstractRepository;

class AuthorRepository extends AbstractRepository
{

    public function getListOfAuthors(): array
    {
        $sql = 'SELECT author.id, user.full_name, user.birth_date, user.gender, author.posts, author.likes, user.create_time 
        FROM ' . $this->getTableName() .
        ' JOIN user ON author.user_id = user.id 
        WHERE author.posts > 0 ORDER BY id ASC';
        return array_map(fn($row) => Author::fromArray($row), $this->db->select($sql));
    }
    protected function getTableName(): string
    {
        return 'author';
    }
}