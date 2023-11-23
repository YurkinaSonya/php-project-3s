<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class UserDto extends AbstractDto
{
    protected ?string $id = null;
    protected ?DateTimeJsonable $createTime = null;
    protected ?string $fullName = null;
    protected ?DateTimeJsonable $birthDate = null;
    protected ?string $gender = null;
    protected ?string $email = null;
    protected ?string $phoneNumber = null;

    /**
     * @param string|null $id
     * @param DateTimeJsonable|null $createTime
     * @param string|null $fullName
     * @param DateTimeJsonable|null $birthDate
     * @param string|null $gender
     * @param string|null $email
     * @param string|null $phoneNumber
     */
    public function __construct(?string $id = null, ?DateTimeJsonable $createTime = null, ?string $fullName = null, ?DateTimeJsonable $birthDate = null, ?string $gender = null, ?string $email = null, ?string $phoneNumber = null)
    {
        $this->id = $id;
        $this->createTime = $createTime;
        $this->fullName = $fullName;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
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

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }



    protected static function getDtoTypes(): array
    {
        return ['createTime' => DateTimeJsonable::class, 'birthDate' => DateTimeJsonable::class];
    }


}