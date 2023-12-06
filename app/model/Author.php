<?php

namespace app\model;

use core\model\AbstractModel;

class Author extends AbstractModel
{
    protected ?string $id;
    protected string $userId;
    protected int $posts;
    protected int $likes;

    /**
     * @param string|null $id
     * @param string $userId
     * @param int $posts
     * @param int $likes
     */
    public function __construct(?string $id, string $userId, int $posts, int $likes)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->posts = $posts;
        $this->likes = $likes;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getPosts(): int
    {
        return $this->posts;
    }

    public function setPosts(int $posts): void
    {
        $this->posts = $posts;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }


    /**
     * @inheritDoc
     */
    static public function getModelDbFields(): array
    {
        return ['id' => 'id', 'user_id' => 'userId', 'posts' => 'posts', 'likes' => 'likes'];
    }

    static protected function getModelDoubleFieldExample(): ?string
    {
        return 'user_id';
    }
}