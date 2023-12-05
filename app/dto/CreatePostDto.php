<?php

namespace app\dto;

use core\dto\AbstractDto;

class CreatePostDto extends AbstractDto
{
    protected string $title;
    protected string $description;
    protected int $readingTime;
    protected ?string $image = null;
    protected ?string $addressId = null;
    protected array $tags = [];

    /**
     * @param string $title
     * @param string $description
     * @param int $readingTime
     * @param string|null $image
     * @param string|null $addressId
     * @param array|null $tags
     */
    public function __construct(string $title, string $description, int $readingTime, ?string $image, ?string $addressId, array $tags = [])
    {
        $this->title = $title;
        $this->description = $description;
        $this->readingTime = $readingTime;
        $this->image = $image;
        $this->addressId = $addressId;
        $this->tags = $tags;
    }


    protected static function getDtoTypes(): array
    {
        return [];
    }
}