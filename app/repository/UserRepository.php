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
        if ($user->getId() === null) {
            $user->setCreateTime(new \DateTime());
        }
        $this->save($user);
        return $user->getId();
    }

    public function findByEmail(string $email, ?string $password = null) : ?User
    {
        $sql = 'SELECT * FROM user WHERE email = "' . $email . '"';
        if ($password !== null) {
            $sql .= ' AND password = "' . $password . '"';
        }
        $result = $this->db->selectOne($sql);
        //var_export($result); die;
        return $result ? User::fromArray($result) : null;
    }

    public function findById(string $id) : ?User
    {
        $sql = 'SELECT * FROM user WHERE id = "' . $id . '"';
        $result = $this->db->selectOne($sql);
        return $result ? User::fromArray($result) : null;
    }

    public function updateUser()
    {

    }

    protected function getTableName(): string
    {
        return 'user';
    }


}