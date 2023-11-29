<?php

namespace app\repository;

use core\repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    protected function getTableName(): string
    {
        return 'post';
    }
}