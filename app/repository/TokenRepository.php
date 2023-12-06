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


    public function createToken(Token $token): void
    {
        $token->setCreateTime(new \DateTime());
        $token->setExpireTime(new \DateTime('+' . $this->ttl . ' seconds'));
        $this->save($token);
    }

    public function updateToken(Token $token) : void
    {
        $this->save($token);
    }

    public function findByToken(string $token) : ?Token
    {
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');
        $sql = 'SELECT * FROM user_token WHERE `value` = "' . $this->db->escape($token) . '" AND expire_time > "' . $currentDate . '" AND logout_time IS NULL';
        $result = $this->db->selectOne($sql);
        return Token::fromArray($result);
    }

    public function setLogoutTime(string $token) : void
    {

    }

    protected function getTableName(): string
    {
        return 'user_token';
    }


}