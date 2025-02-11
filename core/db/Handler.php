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

    public function selectColumn(string $sql, string $columnName) : array;
    public function selectColumnOne(string $sql, string $columnName) : mixed;
    public function insert($tableName, $values): bool|int;
    public function update(string $tableName, array $values, ?string $where = null): bool|int;
    public function execute(string $sql) : bool|int;
    public function escape(string $string) : string;
    public function getLastInsertId(): int;


}