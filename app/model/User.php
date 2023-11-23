<?php

namespace app\model;

use core\model\AbstractModel;

class User extends AbstractModel
{
    protected ?string $id;
    protected string $email;
    protected string $password;
    protected ?\DateTime $createTime;
    protected string $fullName;
    protected string $gender;
    protected ?\DateTime $birthDate;
    protected ?string $phoneNumber;

    /**
     * @param string $id
     * @param string $email
     * @param string $password
     * @param \DateTime|null $createTime
     * @param string $fullName
     * @param string $gender
     * @param \DateTime|null $birthDate
     * @param string|null $phoneNumber
     */
    public function __construct(?string $id, string $email, string $password, ?\DateTime $createTime, string $fullName, string $gender, ?\DateTime $birthDate, ?string $phoneNumber)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createTime = $createTime;
        $this->fullName = $fullName;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public static function getModelDbFields(): array
    {
        return ['id' => 'id', 'email' => 'email', 'password' => 'password', 'create_time' => 'createTime', 'full_name' => 'fullName', 'gender' => 'gender', 'birth_date' => 'birthDate', 'phone_number' => 'phoneNumber'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class, 'birth_date' => \DateTime::class];
    }

    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'birth_date';
    }


}