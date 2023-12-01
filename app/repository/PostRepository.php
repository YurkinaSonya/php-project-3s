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
        ?array $subscribes,
        ?array $admins,
        ?string $sorting
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
                        $userId, $subscribes, $admins
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
        ?array $subscribes,
        ?array $admins
    ) : int
    {
        $sql = 'SELECT COUNT(*) as cnt' . $this->sqlWithTerms(
                                                        $tags, $author, $min,
                                                        $max, $onlyMyCommunities,
                                                        $userId, $subscribes, $admins
                                                        );
        return $this->db->selectColumnOne($sql, 'cnt');
    }

    private function sqlWithTerms(
        ?array $tags,
        ?string $author,
        ?string $min,
        ?string $max,
        ?bool $onlyMyCommunities,
        ?string $userId,
        ?array $subscribes,
        ?array $admins
    ) : string
    {
        $whereTerms = $this->generateWhereTerms(
            $tags, $author, $min,
            $max, $onlyMyCommunities,
            $userId, $subscribes, $admins
        );;
        $sql = ' FROM ' . $this->getTableName();
        if ($tags) {
            $sql .= ' JOIN post_tags ON post.id = post_tags.post_id ';
        }
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
        ?array $subscribes,
        ?array $admins
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
        if ($onlyMyCommunities === true and $userId !== null) {
            $myCommunitiesIds = [];
            foreach ($subscribes as $subCommunityId) {
                $myCommunitiesIds[] = $subCommunityId;
            }
            foreach ($admins as $adminCommunityId) {
                if (!in_array($adminCommunityId, $myCommunitiesIds)) {
                    $myCommunitiesIds[] = $adminCommunityId;
                }
            }
            $whereTerms[] = ' post.community_id in ("' . implode('", "', $myCommunitiesIds) .'")';
        }
        return $whereTerms;
    }

    protected function getTableName(): string
    {
        return 'post';
    }
}