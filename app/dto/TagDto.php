<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class TagDto extends AbstractDto
{
    protected ?string $id = null;
    protected ?string $name = null;
    protected ?DateTimeJsonable $createTime = null;

    /**
     * @param string|null $id
     * @param string|null $name
     * @param DateTimeJsonable|null $createTime
     */
    public function __construct(?string $id = null, ?string $name = null, ?DateTimeJsonable $createTime = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createTime = $createTime;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCreateTime(): ?DateTimeJsonable
    {
        return $this->createTime;
    }

    public function setCreateTime(?DateTimeJsonable $createTime): void
    {
        $this->createTime = $createTime;
    }

    protected static function getDtoTypes(): array
    {
        return ['createTime' => DateTimeJsonable::class];
    }
}