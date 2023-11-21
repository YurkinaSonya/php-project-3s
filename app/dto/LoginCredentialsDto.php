<?php

namespace app\dto;

use core\dto\AbstractDto;

class LoginCredentialsDto extends AbstractDto
{
    private ?string $email;
    private ?string $password;

    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(?string $email = null, ?string $password = null)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    protected static function getDtoTypes(): array
    {
        return [];
    }


}