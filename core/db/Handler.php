<?php

namespace core\db;

interface Handler
{
    public function __construct(
        string $user,
        string $password,
        string $dbName,
        ?string $host = null,
        ?string $port = null
    );

    public function connect(): void;

    public function select(string $sql) : array;
    public function selectOne(string $sql) : array|null;
    public function execute(string $sql) : bool|int;
    public function getLastInsertId(): int;


}