<?php

namespace app\repository;

use app\model\User;
use core\db\Handler;
use core\model\AbstractModel;
use core\repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function createUser(User $user): string
    {
        $user->setCreateTime(new \DateTime());
        $this->save($user);
        return $user->getId();
    }

    public function updateUser(User $user):string
    {
        $this->save($user);
        return $user->getId();
    }

    public function findByEmail(string $email, ?string $password = null) : ?User
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE email = "' . $this->db->escape($email) . '"';
        if ($password !== null) {
            $sql .= ' AND password = "' . $password . '"';
        }
        $result = $this->db->selectOne($sql);
        //var_export($result); die;
        return $result ? User::fromArray($result) : null;
    }

    public function findById(string $id) : ?User
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = "' . $this->db->escape($id) . '"';
        $result = $this->db->selectOne($sql);
        return $result ? User::fromArray($result) : null;
    }

    public function getListByIds(array $ids): array
    {
        $in = '("' . implode('","', $ids) .'")';
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id IN ' . $this->db->escape($in);
        return array_map(fn($row) => User::fromArray($row), $this->db->select($sql));
    }

    protected function getTableName(): string
    {
        return 'user';
    }


}