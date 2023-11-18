<?php

namespace app\model;

class Film
{
    private int $id;
    private string $title;
    private int $year;

    /**
     * @param int $id
     * @param string $title
     * @param int $year
     */
    public function __construct(int $id, string $title, int $year)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
    }

    public function toArray() : array
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }


}