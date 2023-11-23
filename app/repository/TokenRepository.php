<?php

namespace app\repository;

use app\model\Token;
use core\db\Handler;
use core\model\AbstractModel;
use core\repository\AbstractRepository;

class TokenRepository extends AbstractRepository
{
    private int $ttl;

    /**
     * @param Handler $db
     * @param int $ttl
     */
    public function __construct(Handler $db, int $ttl)
    {
        parent::__construct($db);
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

    public function findByToken(string $token) : ?Token
    {
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');
        $sql = 'SELECT * FROM user_token WHERE `value` = "' . $token . '" AND expire_time > "' . $currentDate . '" AND logout_time IS NULL';
        $result = $this->db->selectOne($sql);
        return Token::fromArray($result);
    }

    protected function getTableName(): string
    {
        return 'user_token';
    }


}