<?php

namespace app\dto;

use core\dto\AbstractDto;

class CommunityUserDto extends AbstractDto
{
    protected ?string $userId = null;
    protected ?string $communityId = null;
    protected ?string $role = null;

    /**
     * @param string|null $userId
     * @param string|null $communityId
     * @param string|null $role
     */
    public function __construct(?string $userId = null, ?string $communityId = null, ?string $role = null)
    {
        $this->userId = $userId;
        $this->communityId = $communityId;
        $this->role = $role;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(?string $userId): void
    {
        $this->userId = $userId;
    }

    public function getCommunityId(): ?string
    {
        return $this->communityId;
    }

    public function setCommunityId(?string $communityId): void
    {
        $this->communityId = $communityId;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }


    protected static function getDtoTypes(): array
    {
        return [];
    }
}