<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class UserEditDto extends AbstractDto
{
    protected string $email;
    protected string $fullName;
    protected DateTimeJsonable $birthDate;
    protected string $gender;
    protected string $phoneNumber;

    protected static function getDtoTypes(): array
    {
        return ['birthDate' => DateTimeJsonable::class];
    }
}