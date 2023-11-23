<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class CommunityDto extends AbstractDto
{
    protected ?string $id = null;
    protected ?DateTimeJsonable $createTime = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?bool $isClosed = null;
    protected ?int $subscribersCount = null;

    /**
     * @param string|null $id
     * @param DateTimeJsonable|null $createTime
     * @param string|null $name
     * @param string|null $description
     * @param bool|null $isClosed
     * @param int|null $subscribersCount
     */
    public function __construct(?string $id, ?DateTimeJsonable $createTime, ?string $name, ?string $description, ?bool $isClosed, ?int $subscribersCount)
    {
        $this->id = $id;
        $this->createTime = $createTime;
        $this->name = $name;
        $this->description = $description;
        $this->isClosed = $isClosed;
        $this->subscribersCount = $subscribersCount;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getCreateTime(): ?DateTimeJsonable
    {
        return $this->createTime;
    }

    public function setCreateTime(?DateTimeJsonable $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(?bool $isClosed): void
    {
        $this->isClosed = $isClosed;
    }

    public function getSubscribersCount(): ?int
    {
        return $this->subscribersCount;
    }

    public function setSubscribersCount(?int $subscribersCount): void
    {
        $this->subscribersCount = $subscribersCount;
    }




    protected static function getDtoTypes(): array
    {
        return ['createTime' => DateTimeJsonable::class];
    }
}