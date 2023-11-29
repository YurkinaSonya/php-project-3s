<?php

namespace app\model;

use core\model\AbstractModel;

class Post extends AbstractModel
{
    protected ?string $id;
    protected \DateTime $createTime;
    protected string $title;
    protected string $description;
    protected int $readingTime;
    protected string $authorId;
    protected string $authorName;
    protected int $likes;
    protected int $hasLike;
    protected int $commentsCount;
    protected ?string $image = null;
    protected ?string $communityId = null;
    protected ?string $communityName = null;
    protected ?string $addressId = null;

    /**
     * @param string|null $id
     * @param \DateTime $createTime
     * @param string $title
     * @param string $description
     * @param int $readingTime
     * @param string $authorId
     * @param string $authorName
     * @param int $likes
     * @param int $hasLike
     * @param int $commentsCount
     * @param string|null $image
     * @param string|null $communityId
     * @param string|null $communityName
     * @param string|null $addressId
     */
    public function __construct(?string $id, \DateTime $createTime, string $title, string $description, int $readingTime, string $authorId, string $authorName, int $likes, int $hasLike, int $commentsCount, ?string $image = null, ?string $communityId = null, ?string $communityName = null, ?string $addressId = null)
    {
        $this->id = $id;
        $this->createTime = $createTime;
        $this->title = $title;
        $this->description = $description;
        $this->readingTime = $readingTime;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->likes = $likes;
        $this->hasLike = $hasLike;
        $this->commentsCount = $commentsCount;
        $this->image = $image;
        $this->communityId = $communityId;
        $this->communityName = $communityName;
        $this->addressId = $addressId;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getReadingTime(): int
    {
        return $this->readingTime;
    }

    public function setReadingTime(int $readingTime): void
    {
        $this->readingTime = $readingTime;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function setAuthorId(string $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    public function getHasLike(): int
    {
        return $this->hasLike;
    }

    public function setHasLike(int $hasLike): void
    {
        $this->hasLike = $hasLike;
    }

    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    public function setCommentsCount(int $commentsCount): void
    {
        $this->commentsCount = $commentsCount;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCommunityId(): ?string
    {
        return $this->communityId;
    }

    public function setCommunityId(?string $communityId): void
    {
        $this->communityId = $communityId;
    }

    public function getCommunityName(): ?string
    {
        return $this->communityName;
    }

    public function setCommunityName(?string $communityName): void
    {
        $this->communityName = $communityName;
    }

    public function getAddressId(): ?string
    {
        return $this->addressId;
    }

    public function setAddressId(?string $addressId): void
    {
        $this->addressId = $addressId;
    }

    static public function getModelDbFields(): array
    {
        return ['id' =>'id', 'create_time' => 'createTime', 'title' => 'title', 'description' => 'description', 'reading_time' => 'readingTime', 'author_id' => 'authorId', 'author_name' => 'authorName', 'likes' => 'likes', 'has_like' => 'has_like', 'comments_count' => 'commentsCount', 'image' => 'image', 'community_id' => 'communityId', 'community_name' => 'communityName', 'address_id' => 'addressId'];
    }

    protected static function getModelDbComplexFields(): array
    {
        return ['create_time' => \DateTime::class];
    }


    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'create_time';
    }
}