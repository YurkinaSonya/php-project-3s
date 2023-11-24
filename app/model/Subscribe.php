<?php

namespace app\model;

use core\model\AbstractModel;

class Subscribe extends AbstractModel
{
    protected ?string $id;
    protected string $userId;
    protected string $communityId;
    protected ?\DateTime $subscribeTime;
    protected ?\DateTime $unsubscribeTime;

    /**
     * @param string|null $id
     * @param string $userId
     * @param string $communityId
     * @param \DateTime|null $subscribeTime
     * @param \DateTime|null $unsubscribeTime
     */
    public function __construct(?string $id, string $userId, string $communityId, ?\DateTime $subscribeTime = null, ?\DateTime $unsubscribeTime = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->communityId = $communityId;
        $this->subscribeTime = $subscribeTime;
        $this->unsubscribeTime = $unsubscribeTime;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
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

    public function getCommunityId(): string
    {
        return $this->communityId;
    }

    public function setCommunityId(string $communityId): void
    {
        $this->communityId = $communityId;
    }

    public function getSubscribeTime(): ?\DateTime
    {
        return $this->subscribeTime;
    }

    public function setSubscribeTime(?\DateTime $subscribeTime): void
    {
        $this->subscribeTime = $subscribeTime;
    }

    public function getUnsubscribeTime(): ?\DateTime
    {
        return $this->unsubscribeTime;
    }

    public function setUnsubscribeTime(?\DateTime $unsubscribeTime): void
    {
        $this->unsubscribeTime = $unsubscribeTime;
    }

    /**
     * @return string[]
     */
    static public function getModelDbFields(): array
    {
        return ['id' => 'id', 'user_id' => 'userId', 'community_id' => 'communityId', 'subscribe_time' => 'subscribeTime', 'unsubscribe_time' => 'unsubscribeTime'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['subscribe_time' => \DateTime::class, 'unsubscribe_time' => \DateTime::class];
    }


    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'subscribe_time';
    }
}