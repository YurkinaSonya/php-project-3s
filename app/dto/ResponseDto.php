<?php

namespace app\dto;

use core\dto\AbstractDto;

class ResponseDto extends AbstractDto
{
    protected ?string $status = null;
    protected ?string $message = null;

    /**
     * @param string|null $status
     * @param string|null $message
     */
    public function __construct(?string $status = null, ?string $message = null)
    {
        $this->status = $status;
        $this->message = $message;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }




    protected static function getDtoTypes(): array
    {
        return [];
    }
}