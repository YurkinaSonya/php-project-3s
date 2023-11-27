<?php

namespace app\model;

use core\model\AbstractModel;

class Address extends AbstractModel
{
    protected int $objectId;
    protected string $id;
    protected string $text;
    protected string $textSearch;
    protected int $level;
    protected int $parentObjectId;
    protected string $path;

    /**
     * @param int $objectId
     * @param string $id
     * @param string $text
     * @param string $textSearch
     * @param int $level
     * @param int $parentObjectId
     * @param string $path
     */
    public function __construct(int $objectId, string $id, string $text, string $textSearch, int $level, int $parentObjectId, string $path)
    {
        $this->objectId = $objectId;
        $this->id = $id;
        $this->text = $text;
        $this->textSearch = $textSearch;
        $this->level = $level;
        $this->parentObjectId = $parentObjectId;
        $this->path = $path;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getObjectId(): int
    {
        return $this->objectId;
    }

    public function setObjectId(int $objectId): void
    {
        $this->objectId = $objectId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getTextSearch(): string
    {
        return $this->textSearch;
    }

    public function setTextSearch(string $textSearch): void
    {
        $this->textSearch = $textSearch;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getParentObjectId(): int
    {
        return $this->parentObjectId;
    }

    public function setParentObjectId(int $parentObjectId): void
    {
        $this->parentObjectId = $parentObjectId;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }


    static public function getModelDbFields(): array
    {
        return ['obj_id' => 'objectId', 'guid' => 'id', 'text' => 'text', 'text_search' => 'textSearch', 'level' => 'level', 'parent_obj_id' => 'parentObjectId', 'path' => 'path'];
    }

    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'obj_id';
    }
}