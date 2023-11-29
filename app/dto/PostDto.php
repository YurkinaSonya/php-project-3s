<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class PostDto extends AbstractDto
{
    protected ?string $id;
    protected DateTimeJsonable $createTime;
    protected string $title;
    protected string $description;
    protected int $readingTime;
    protected ?string $image = null;
    protected string $authorId;
    protected string $authorName;
    protected ?string $communityId = null;
    protected ?string $communityName = null;
    protected ?string $addressId = null;
    protected int $likes;
    protected int $hasLike;
    protected int $commentsCount;
    protected array $tags;

    /**
     * @param string|null $id
     * @param DateTimeJsonable $createTime
     * @param string $title
     * @param string $description
     * @param int $readingTime
     * @param string|null $image
     * @param string $authorId
     * @param string $authorName
     * @param string|null $communityId
     * @param string|null $communityName
     * @param string|null $addressId
     * @param int $likes
     * @param int $hasLike
     * @param int $commentsCount
     * @param TagDto[] $tags
     */
    public function __construct(?string $id, DateTimeJsonable $createTime, string $title, string $description, int $readingTime, ?string $image, string $authorId, string $authorName, ?string $communityId, ?string $communityName, ?string $addressId, int $likes, int $hasLike, int $commentsCount, array $tags)
    {
        $this->id = $id;
        $this->createTime = $createTime;
        $this->title = $title;
        $this->description = $description;
        $this->readingTime = $readingTime;
        $this->image = $image;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->communityId = $communityId;
        $this->communityName = $communityName;
        $this->addressId = $addressId;
        $this->likes = $likes;
        $this->hasLike = $hasLike;
        $this->commentsCount = $commentsCount;
        $this->tags = $tags;
    }



    protected static function getDtoTypes(): array
    {
        return ['createTime' => DateTimeJsonable::class];
    }
}