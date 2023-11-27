<?php

namespace app\dto;

use core\dto\AbstractDto;

class SearchAddressDto extends AbstractDto
{
    protected ?int $objectId = null;
    protected ?string $objectGuid = null;
    protected ?string $text = null;
    protected ?string $objectLevel = null;
    protected ?string $objectLevelText = null;

    /**
     * @param int|null $objectId
     * @param string|null $objectGuid
     * @param string|null $text
     * @param string|null $objectLevel
     * @param string|null $objectLevelText
     */
    public function __construct(?int $objectId, ?string $objectGuid, ?string $text, ?string $objectLevel, ?string $objectLevelText)
    {
        $this->objectId = $objectId;
        $this->objectGuid = $objectGuid;
        $this->text = $text;
        $this->objectLevel = $objectLevel;
        $this->objectLevelText = $objectLevelText;
    }

    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    public function setObjectId(?int $objectId): void
    {
        $this->objectId = $objectId;
    }

    public function getObjectGuid(): ?string
    {
        return $this->objectGuid;
    }

    public function setObjectGuid(?string $objectGuid): void
    {
        $this->objectGuid = $objectGuid;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getObjectLevel(): ?string
    {
        return $this->objectLevel;
    }

    public function setObjectLevel(?string $objectLevel): void
    {
        $this->objectLevel = $objectLevel;
    }

    public function getObjectLevelText(): ?string
    {
        return $this->objectLevelText;
    }

    public function setObjectLevelText(?string $objectLevelText): void
    {
        $this->objectLevelText = $objectLevelText;
    }

    protected static function getDtoTypes(): array
    {
        return [];
    }
}