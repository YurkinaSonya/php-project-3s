<?php

namespace app\repository;

use app\model\Film;
use core\db\Handler;

class FilmRepository
{

    private Handler $db;

    /**
     * @param Handler $db
     */
    public function __construct(Handler $db)
    {
        $this->db = $db;
    }


    /**
     * @param int $offset
     * @param int $limit
     * @return Film[]
     */
    public function getList(int $offset, int $limit) : array
    {
        $sql = 'SELECT * FROM film ORDER BY id ASC LIMIT ' . $limit . ' OFFSET ' . $offset;
        return array_map(fn($row) => $this->arrayToFilm($row), $this->db->select($sql));
    }

    public function getListTotalCount() : int
    {
        $sql = 'SELECT count(*) as cnt FROM film';
        $row = $this->db->selectOne($sql);
        return (int)$row['cnt'];
    }



    public function getFilm(int $id) :?Film
    {
        $sql = 'SELECT * FROM film WHERE id = ' . $id;
        $result = $this->db->selectOne($sql);
        return $this->arrayToFilm($result);
    }

    public function addFilm(string $title, int $year) :int
    {
        $sql = "INSERT INTO film (title, release_year) VALUES ('$title','$year');";

        $this->db->execute($sql);

        return $this->db->getLastInsertId();
    }

    public function updateFilm(int $id, string $title, int $year) : int
    {
        $sql = "UPDATE film SET title = '$title', release_year = '$year' WHERE id = '$id';";
        $this->db->execute($sql);
        return $id;
    }

    public function findByTitleAndYear(string $title, int $year) : ?Film
    {
        return $this->arrayToFilm(
            $this->db->selectOne(
                sprintf('SELECT * FROM `film` WHERE `title` = \'%s\' AND release_year = %d', $title, $year)
            )
        );
    }

    public function deleteFilm(int $id) : void
    {
        $sql = "DELETE FROM film WHERE id = '$id';";
        $this->db->execute($sql);
    }

    private function arrayToFilm(?array $array) : ?Film
    {
        if ($array === null) {
            return null;
        }
        foreach (['id', 'title','release_year'] as $key) {
            if (!array_key_exists($key, $array)) {
                return null;
            }
        }
        return new Film($array['id'], $array['title'], $array['release_year']);
    }




}