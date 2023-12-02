<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class PostFullDto extends PostDto
{
    protected ?array $comments = null;

    /**
     * @param array|null $comments
     */
    public function __construct(?string $id, DateTimeJsonable $createTime, string $title, string $description, int $readingTime, ?string $image, string $authorId, string $authorName, ?string $communityId, ?string $communityName, ?string $addressId, int $likes, int $hasLike, int $commentsCount, ?array $tags = null, ?array $comments = null)
    {
        parent::__construct($id, $createTime, $title, $description, $readingTime, $image, $authorId, $authorName, $communityId, $communityName, $addressId, $likes, $hasLike,$commentsCount,$tags);
        $this->comments = $comments;
    }

    public function getComments(): ?array
    {
        return $this->comments;
    }

    public function setComments(?array $comments): void
    {
        $this->comments = $comments;
    }
    protected static function getDtoTypes(): array
    {
        return ['createTime' => DateTimeJsonable::class];
    }
}