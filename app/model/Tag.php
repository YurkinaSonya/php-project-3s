<?php

namespace app\model;

use core\model\AbstractModel;

class Tag extends AbstractModel
{
    protected string $id;
    protected string $name;
    protected ?\DateTime $createTime;

    /**
     * @param string $id
     * @param string $name
     * @param \DateTime|null $createTime
     */
    public function __construct(string $id, string $name, ?\DateTime $createTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createTime = $createTime;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

    static public function getModelDbFields(): array
    {
        return ['id' => 'id', 'name' => 'name', 'create_time' => 'createTime'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class];
    }

    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'create_time';
    }

}