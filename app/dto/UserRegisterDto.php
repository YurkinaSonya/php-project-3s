<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class UserRegisterDto extends AbstractDto
{
    protected ?string $fullName = null;

    protected ?string $password = null;
    protected ?string $email = null;
    protected ?DateTimeJsonable $birthDate = null;
    protected ?string $gender = null;
    protected ?string $phoneNumber = null;

    /**
     * @param string|null $fullName
     * @param string|null $password
     * @param string|null $email
     * @param DateTimeJsonable|null $birthDate
     * @param string|null $gender
     * @param string|null $phoneNumber
     */
    public function __construct(?string $fullName = null, ?string $password = null, ?string $email = null, ?DateTimeJsonable $birthDate = null, ?string $gender = null, ?string $phoneNumber = null)
    {
        $this->fullName = $fullName;
        $this->password = $password;
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->phoneNumber = $phoneNumber;
    }


    protected static function getDtoTypes(): array
    {
        return ['birthDate' => DateTimeJsonable::class];
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
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

    public function getBirthDate(): ?DateTimeJsonable
    {
        return $this->birthDate;
    }

    public function setBirthDate(?DateTimeJsonable $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }


    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
}