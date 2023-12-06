<?php

namespace app\model;

use core\model\AbstractModel;

class Author extends AbstractModel
{
    protected ?string $id;
    protected string $fullName;
    protected \DateTime $birthDate;
    protected string $gender;
    protected int $posts;
    protected int $likes;
    protected \DateTime $created;

    /**
     * @param string|null $id
     * @param string $fullName
     * @param \DateTime $birthDate
     * @param string $gender
     * @param int $posts
     * @param int $likes
     * @param \DateTime $created
     */
    public function __construct(?string $id, string $fullName, \DateTime $birthDate, string $gender, int $posts, int $likes, \DateTime $created)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->posts = $posts;
        $this->likes = $likes;
        $this->created = $created;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }
    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
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

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }




    /**
     * @inheritDoc
     */
    static public function getModelDbFields(): array
    {
        return ['id' => 'id', 'full_name' => 'fullName', 'birth_date' => 'birthDate', 'gender' => 'gender', 'posts' => 'posts', 'likes' => 'likes', 'create_time' => 'created'];
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