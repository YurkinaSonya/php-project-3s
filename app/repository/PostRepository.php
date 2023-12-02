<?php

namespace app\repository;

use app\model\Post;
use core\repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    public function getList(
        int $offset,
        int $limit,
        ?array $tags,
        ?string $author,
        ?string $min,
        ?string $max,
        ?bool $onlyMyCommunities,
        ?string $userId,
        ?array $myCommunitiesIds,
        ?string $sorting,
        ?string $communityId = null
    ) : array
    {
        $order = null;
        $sortingCases = [
            'CreateDesc' => 'create_time Desc ',
            'CreateAsc' => 'create_time Asc ',
            'LikeDesc' => 'likes Desc ',
            'LikeAsc' => 'likes Asc '
        ];
        if ($sorting) {
            $order = ' ORDER BY post.' . $sortingCases[$sorting];
        }
        $terms = $this->sqlWithTerms(
                        $tags, $author, $min,
                        $max, $onlyMyCommunities,
                        $userId, $myCommunitiesIds,
                        $communityId
                        );
        $sql = 'SELECT  post.* ' . $terms . $order . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        return array_map(fn($row) => Post::fromArray($row), $this->db->select($sql));
    }



    public function getTotalCount(
        ?array $tags,
        ?string $author,
        ?string $min,
        ?string $max,
        ?bool $onlyMyCommunities,
        ?string $userId,
        ?array $myCommunitiesIds,
        ?string $communityId = null
    ) : int
    {
        $sql = 'SELECT COUNT(*) as cnt' . $this->sqlWithTerms(
                                                        $tags, $author, $min,
                                                        $max, $onlyMyCommunities,
                                                        $userId, $myCommunitiesIds,
                                                        $communityId
                                                        );
        return $this->db->selectColumnOne($sql, 'cnt') ?: 0;
    }

    private function sqlWithTerms(
        ?array $tags,
        ?string $author,
        ?string $min,
        ?string $max,
        ?bool $onlyMyCommunities,
        ?string $userId,
        ?array $myCommunitiesIds,
        ?string $communityId = null
    ) : string
    {
        $whereTerms = $this->generateWhereTerms(
            $tags, $author, $min,
            $max, $onlyMyCommunities,
            $userId, $myCommunitiesIds,
            $communityId
        );;
        $sql = ' FROM ' . $this->getTableName();
        if ($tags) {
            $sql .= ' JOIN post_tags ON post.id = post_tags.post_id ';
        }
        $sql .= ' LEFT JOIN community ON post.community_id = community.id ';
        if ($whereTerms) {
            $sql.= ' WHERE ' . implode(' AND ', $whereTerms);
        }
        $sql .= ' GROUP BY post.id ';
        return $sql;
    }

    private function generateWhereTerms(
        ?array $tags,
        ?string $author,
        ?string $min,
        ?string $max,
        ?bool $onlyMyCommunities,
        ?string $userId,
        ?array $myCommunitiesIds,
        ?string $communityId = null
    ) : array
    {
        $whereTerms = [];
        if ($tags) {
            $inTags = '("' . implode('","', $tags) .'")';
            $whereTerms[] = ' post_tags.tag_id in ' . $inTags;
        }
        if ($author) {
            $whereTerms[] = ' post.author_name LIKE "%' . $author . '%"';
        }
        if ($min) {
            $whereTerms[] = ' post.reading_time >= ' . $min;
        }
        if ($max) {
            $whereTerms[] = ' post.reading_time <= ' . $max;
        }
        if ($onlyMyCommunities === true && $userId !== null) {
            $whereTerms[] = ' post.community_id in ("' . implode('", "', $myCommunitiesIds) .'")';
        }
        $closedCommunities = ' (community.id IS NULL or community.is_closed = 0 ';
        if ($myCommunitiesIds !== null) {
            $closedCommunities .= 'or community.id in ("' .  implode('", "', $myCommunitiesIds). '")';
        }
        $closedCommunities .= ') ';
        if ($communityId !== null) {
            $whereTerms[] = ' post.community_id = "' . $communityId . '" ';
        }
        $whereTerms[] = $closedCommunities;
        return $whereTerms;
    }
    public function getPost(string $id) : ?Post
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $id . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Post::fromArray($result) : null;
    }

    public function getCommunityOFPost(string $postId) : ?string
    {
        $sql = 'SELECT community_id FROM ' . $this->getTableName() . ' WHERE id = "' . $postId . '"';
        return $this->db->selectColumnOne($sql, 'community_id');
    }

    protected function getTableName(): string
    {
        return 'post';
    }
}