<?php

namespace app\repository;

use core\repository\AbstractRepository;

class AdministratorRepository extends AbstractRepository
{

    public function getAdministratorIds(string $communityId) : array
    {
        $sql = 'SELECT user_id FROM ' . $this->getTableName() . ' WHERE community_id = "' . $this->db->escape($communityId) .  '"';
        $middleResult = $this->db->select($sql);
        $result = [];
        foreach ($middleResult as $res) {
            $result[] = $res['user_id'];
        }
        return $result;
    }

    public function getAdminRolesOfUser(string $userId) : array
    {
        $sql = 'SELECT community_id FROM ' . $this->getTableName() . ' WHERE user_id = "' . $this->db->escape($userId) .  '"';
        return  $this->db->selectColumn($sql, 'community_id');
    }

    public function findAdminByUserIdCommunityId(string $userId, string $communityId) :?array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE user_id = "' . $this->db->escape($userId) . '" AND community_id = "' . $this->db->escape($communityId) . '"';
        return $this->db->selectOne($sql);
    }


    protected function getTableName(): string
    {
        return 'administrator';
    }
}