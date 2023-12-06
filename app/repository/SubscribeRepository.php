<?php

namespace app\repository;

use app\model\Subscribe;
use core\repository\AbstractRepository;

class SubscribeRepository extends AbstractRepository
{
    public function subscribe(Subscribe $subscribe) : void
    {
        $subscribe->setSubscribeTime(new \DateTime());
        $this->save($subscribe);
    }
    public function unsubscribe(Subscribe $subscribe) : void
    {
        $subscribe->setUnsubscribeTime(new \DateTime());
        $this->save($subscribe);
    }

    public function getSubscribesOfUser(string $userId) : array
    {
        $sql = 'SELECT community_id FROM ' . $this->getTableName() . ' WHERE user_id = "' . $this->db->escape($userId) . '" AND unsubscribe_time IS NULL';
        $result = $this->db->selectColumn($sql, 'community_id');
//        $result = [];
//        foreach ($middleResult as $res) {
//            $result[] = $res['community_id'];
//        }
        return $result;
    }

    public function findByUserIdCommunityId(string $userId, string $communityId) :?Subscribe
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE user_id = "' . $this->db->escape($userId) . '" AND community_id = "' . $this->db->escape($communityId) . '" AND unsubscribe_time IS NULL';
        $result = $this->db->selectOne($sql);
        return $result ? Subscribe::fromArray($result) : null;
    }
    protected function getTableName(): string
    {
        return 'subscriber';
    }
}