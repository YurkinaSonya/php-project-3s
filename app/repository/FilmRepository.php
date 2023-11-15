<?php

namespace app\repository;

use app\model\Film;

class FilmRepository
{
    /**
     * @param int $offset
     * @param int $limit
     * @return Film[]
     */
    public function getList(int $offset, int $limit) : array
    {
        return array_slice($this->getFullList(), $offset, $limit);
    }

    public function getListTotalCount() : int
    {
        return count($this->getFullList());
    }

    public function getFilm(int $id) : ?Film
    {
        foreach ($this->getFullList() as $film) {
            if ($film->getId() === $id) {
                return $film;
            }
        }
        return null;
    }

    /**
     * @return Film[]
     */
    private function getFullList(): array
    {
        $id = 0;
        return [
            new Film(++$id, "Avatar", 2000),
            new Film(++$id, "A", 2001),
            new Film(++$id, "B", 2002),
            new Film(++$id, "C", 2000),
            new Film(++$id, "D", 2000),
            new Film(++$id, "E", 2000),
            new Film(++$id, "F", 2000),
            new Film(++$id, "G", 2000),
            new Film(++$id, "H", 2000),
            new Film(++$id, "I", 2000),
            new Film(++$id, "J", 2000),
            new Film(++$id, "K", 2000),
            new Film(++$id, "L", 2000),
            new Film(++$id, "M", 2000),
            new Film(++$id, "N", 2000),
            new Film(++$id, "O", 2000),
            new Film(++$id, "P", 2000),
        ];
    }


}