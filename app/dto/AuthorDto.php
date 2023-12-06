<?php

namespace app\dto;

use core\dto\AbstractDto;
use core\types\DateTimeJsonable;

class AuthorDto extends AbstractDto
{
    protected ?string $fullName;
    protected ?DateTimeJsonable $birthDate;
    protected ?string $gender;
    protected int $posts;
    protected int $likes;
    protected ?DateTimeJsonable $created;

    /**
     * @param string|null $fullName
     * @param DateTimeJsonable|null $birthDate
     * @param string|null $gender
     * @param int $posts
     * @param int $likes
     * @param DateTimeJsonable|null $created
     */
    public function __construct(?string $fullName, ?DateTimeJsonable $birthDate, ?string $gender, int $posts, int $likes, ?DateTimeJsonable $created)
    {
        $this->fullName = $fullName;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->posts = $posts;
        $this->likes = $likes;
        $this->created = $created;
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

    public function getCreated(): ?DateTimeJsonable
    {
        return $this->created;
    }

    public function setCreated(?DateTimeJsonable $created): void
    {
        $this->created = $created;
    }

    protected static function getDtoTypes(): array
    {
        return ['created' => DateTimeJsonable::class, 'birthDate' => DateTimeJsonable::class];
    }
}