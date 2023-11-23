<?php

namespace app\model;


use core\model\AbstractModel;

class Token extends AbstractModel
{
    private string $id;
    private string $userId;
    private string $value;
    private \DateTime $createTime;
    private \DateTime $expireTime;
    private ?\DateTime $logoutTime;

    /**
     * @param string $id
     * @param string $userId
     * @param string $value
     * @param \DateTime $createTime
     * @param \DateTime $expireTime
     * @param \DateTime|null $logoutTime
     */
    public function __construct(string $id, string $userId, string $value, \DateTime $createTime, \DateTime $expireTime, ?\DateTime $logoutTime)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->value = $value;
        $this->createTime = $createTime;
        $this->expireTime = $expireTime;
        $this->logoutTime = $logoutTime;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getExpireTime(): \DateTime
    {
        return $this->expireTime;
    }

    public function setExpireTime(\DateTime $expireTime): void
    {
        $this->expireTime = $expireTime;
    }

    public function getLogoutTime(): ?\DateTime
    {
        return $this->logoutTime;
    }

    public function setLogoutTime(?\DateTime $logoutTime): void
    {
        $this->logoutTime = $logoutTime;
    }

    public static function getModelDbFields(): array
    {
        return ['id' => 'id', 'user_id' => 'userId', 'value' => 'value', 'create_time' => 'createTime', 'expire_time' => 'expireTime', 'logout_time' => 'logoutTime'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class, 'expire_time' => \DateTime::class, 'logout_time' => \DateTime::class];
    }

    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'create_time';
    }


}