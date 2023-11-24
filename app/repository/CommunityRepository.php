<?php

namespace app\repository;

use app\model\Community;
use core\repository\AbstractRepository;

class CommunityRepository extends AbstractRepository
{
    public function getListOfCommunity(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY id ASC';
        return array_map(fn($row) => Community::fromArray($row), $this->db->select($sql));
    }
    public function getCommunity(string $id) : ?Community
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $id . '"';
        $result = $this->db->selectOne($sql);
        return $result ? Community::fromArray($result) : null;
    }

    public function getAdministratorIds(string $communityId) : array
    {
        $sql = 'SELECT user_id FROM administrator WHERE community_id = "' . $communityId .  '"';
        $middleResult = $this->db->select($sql);
        $result = [];
        foreach ($middleResult as $res) {
            $result[] = $res['user_id'];
        }
        return $result;
    }

    public function getAdminRolesOfUser(string $userId) : array
    {
        $sql = 'SELECT community_id FROM administrator WHERE user_id = "' . $userId .  '"';
        $result = $this->db->selectColumn($sql, 'community_id');
//        $result = [];
//        foreach ($middleResult as $res) {
//            $result[] = $res['community_id'];
//        }
        return $result;
    }

    public function findAdminByUserIdCommunityId(string $userId, string $communityId) :?array
    {
        $sql = 'SELECT * FROM administrator WHERE user_id = "' . $userId . '" AND community_id = "' . $communityId . '"';
        return $this->db->selectOne($sql);
    }


    protected function getTableName(): string
    {
        return 'community';
    }
}