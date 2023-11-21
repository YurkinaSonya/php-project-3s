<?php

namespace app\repository;

use app\model\User;
use core\db\Handler;
use core\repository\AbstractRepository;

class UserRepository extends AbstractRepository
{

    private Handler $db;

    /**
     * @param Handler $db
     */
    public function __construct(Handler $db)
    {
        $this->db = $db;
    }
    public function createUser($email, $password, $fullName, $birthDate, $gender, $phoneNumber): string
    {
        $id = $this->generateUuid();
        $this->db->insert('user', [
            'id' => $id,
            'email' => $email,
            'password' => $password,
            'full_name' => $fullName,
            'birth_date' => $birthDate,
            'gender' => $gender,
            'phone_number' => $phoneNumber,
            'create_time' => new \DateTime()
        ]);
        return $id;
    }

    public function findByEmail(string $email, ?string $password = null) : ?User
    {
        $sql = 'SELECT * FROM user WHERE email = "' . $email . '"';
        if ($password !== null) {
            $sql .= ' AND password = "' . $password . '"';
        }
        $result = $this->db->selectOne($sql);
        return $this->arrayToModel($result);
    }

    protected function getModelClass(): string
    {
        return User::class;
    }

    protected function getModelDbFields(): array
    {
        return ['id', 'email', 'password', 'create_time', 'full_name', 'gender', 'birth_date', 'phone_number'];
    }

    protected function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class, 'birth_date' => \DateTime::class];
    }


}