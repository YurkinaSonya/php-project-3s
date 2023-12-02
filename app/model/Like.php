<?php

namespace app\model;

use core\model\AbstractModel;

class Like extends AbstractModel
{
    protected ?string $id;
    protected string $userId;
    protected string $postId;
    protected ?\DateTime $createTime;
    protected ?\DateTime $deleteTime = null;

    /**
     * @param string|null $id
     * @param string $userId
     * @param string $postId
     * @param \DateTime|null $createTime
     * @param \DateTime|null $deleteTime
     */
    public function __construct(?string $id, string $userId, string $postId, ?\DateTime $createTime, ?\DateTime $deleteTime = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->createTime = $createTime;
        $this->deleteTime = $deleteTime;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function setPostId(string $postId): void
    {
        $this->postId = $postId;
    }

    public function getDeleteTime(): ?\DateTime
    {
        return $this->deleteTime;
    }

    public function setDeleteTime(?\DateTime $deleteTime): void
    {
        $this->deleteTime = $deleteTime;
    }


    /**
     * @inheritDoc
     */
    static public function getModelDbFields(): array
    {
        return ['id' => 'id', 'create_time' => 'createTime', 'delete_time' => 'deleteTime', 'user_id' => 'userId', 'post_id' => 'postId'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class, 'delete_time' => \DateTime::class];
    }


    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'create_time';
    }
}