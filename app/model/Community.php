<?php

namespace app\model;

use core\model\AbstractModel;
use core\types\DateTimeJsonable;

class Community extends AbstractModel
{
    protected string $id;
    protected DateTimeJsonable $createTime;
    protected string $name;
    protected string $description;
    protected bool $isClosed;
    protected int $subscribersCount;

    /**
     * @param string $id
     * @param DateTimeJsonable $createTime
     * @param string $name
     * @param string $description
     * @param bool $isClosed
     * @param int $subscribersCount
     */
    public function __construct(string $id, DateTimeJsonable $createTime, string $name, string $description, bool $isClosed, int $subscribersCount)
    {
        $this->id = $id;
        $this->createTime = $createTime;
        $this->name = $name;
        $this->description = $description;
        $this->isClosed = $isClosed;
        $this->subscribersCount = $subscribersCount;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getCreateTime(): DateTimeJsonable
    {
        return $this->createTime;
    }

    public function setCreateTime(DateTimeJsonable $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): void
    {
        $this->isClosed = $isClosed;
    }

    public function getSubscribersCount(): int
    {
        return $this->subscribersCount;
    }

    public function setSubscribersCount(int $subscribersCount): void
    {
        $this->subscribersCount = $subscribersCount;
    }



}