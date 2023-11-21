<?php

namespace app\repository;

use app\model\Token;
use core\db\Handler;
use core\repository\AbstractRepository;

class TokenRepository extends AbstractRepository
{
    private Handler $db;
    private int $ttl;

    /**
     * @param Handler $db
     * @param int $ttl
     */
    public function __construct(Handler $db, int $ttl)
    {
        $this->db = $db;
        $this->ttl = $ttl;
    }

    public function createToken(string $userId, string $token): void
    {
        $id = $this->generateUuid();
        $this->db->insert('user_token', [
            'id' => $id,
            'user_id' => $userId,
            'value' => $token,
            'create_time' => new \DateTime(),
            'expire_time' => (new \DateTime('+' . $this->ttl . ' seconds')),
            'logout_time' => null
        ]);
    }


    protected function getModelClass(): string
    {
        return Token::class;
    }

    protected function getModelDbFields(): array
    {
        return ['id', 'user_id', 'value', 'create_time', 'expire_time', 'logout_time'];
    }

    protected function getModelDbComplexFields(): array
    {
        return ['create_time', 'expire_time', 'logout_time'];
    }


}