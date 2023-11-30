<?php

namespace app\repository;

use app\model\Post;
use core\repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    public function getList(int $offset, int $limit, array $whereTerms, ?string $order) : array
    {
        $sql = 'SELECT  post.* ' . $this->sqlWithTerms($whereTerms) . ' GROUP BY post.id ' . $order . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        return array_map(fn($row) => Post::fromArray($row), $this->db->select($sql));
    }

    public function getTotalCount(array $whereTerms) : int
    {
        $sql = 'SELECT COUNT(*) ' . $this->sqlWithTerms($whereTerms);
        return $this->db->selectColumnOne($sql, 'COUNT(*)');
    }

    private function sqlWithTerms(array $whereTerms) : string
    {
        $sql = ' FROM ' . $this->getTableName() . ' JOIN post_tags ON post.id = post_tags.post_id ';
        if ($whereTerms) {
            $sql.= ' WHERE ' . implode(' AND ', $whereTerms);
        }
        return $sql;
    }

    protected function getTableName(): string
    {
        return 'post';
    }
}