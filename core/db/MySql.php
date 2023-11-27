<?php

namespace core\db;

use Cassandra\Date;
use core\db\Handler;
use core\http\Response;

class MySql implements Handler
{
    private string $user;
    private string $password;
    private string $dbName;
    private string $host;
    private string $port;
    private $connection;

    public function __construct(
        string $user,
        string $password,
        string $dbName,
        ?string $host = null,
        ?string $port = null
    )
    {
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->host = $host ?? '127.0.0.1';
        $this->port = $port ?? 3306;
    }

    public function connect(): void
    {
        if ($this->connection) {
            return;
        }
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->dbName, $this->port);
        if (!$this->connection) {
            die('connect error: ' . mysqli_error($this->connection));
        }

    }

    public function select(string $sql): array
    {
        $query = $this->query($sql);
        $result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function selectOne(string $sql): array|null
    {
        return mysqli_fetch_assoc($this->query($sql));
    }

    public function selectColumn(string $sql, string $columnName) : array
    {
        $select = $this->select($sql);
        $result = [];
        foreach ($select as  $row) {
            $result[] = $row[$columnName];
        }
        return $result;
    }
    public function selectColumnOne(string $sql, string $columnName) : mixed
    {
        return $this->selectOne($sql)[$columnName];
    }

    public function insert($tableName, $values): bool|int
    {
        return $this->execute(sprintf(
            'INSERT INTO `%s` SET %s',
            $tableName,
            implode(', ', $this->valuesToString($values))
        ));
    }

    public function update(string $tableName, array $values, ?string $where = null): bool|int
    {
        return $this->execute(sprintf(
            'UPDATE `%s` set %s%s',
            $tableName,
            implode(', ', $this->valuesToString($values)),
            $where ? (' WHERE ' . $where) : ''
        ));
    }


    public function execute(string $sql): bool|int
    {
        return $this->query($sql);
    }

    public function getLastInsertId(): int
    {
        $this->connect();
        return mysqli_insert_id($this->connection);
    }

    /**
     * @param string $sql
     * @return bool|\mysqli_result|void
     */
    private function query(string $sql)
    {
        $this->connect();
        try {
            $query = mysqli_query($this->connection, $sql);
        }
        catch (\mysqli_sql_exception $exception) {
            die('query error: ' . $exception->getMessage() . ', QUERY :' . $sql);
        }
        if ($query === false) {
            die('query error: ' . mysqli_error($this->connection));
        }
        return $query;
    }

    private function valuesToString(array $values) : array
    {
        return array_map(fn($field, $value): string => sprintf(
            '`%s` = %s',
            $field,
            $this->addQuotes($value)
        ), array_keys($values), array_values($values));
    }

    private function addQuotes(mixed $value): string
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return (int)$value;
        }

        if ($value === null) {
            return 'NULL';
        }

        if ($value instanceof \DateTime) {
            $value = $value->format('Y-m-d H:i:s');
        }

        return '\'' . mysqli_escape_string($this->connection, $value) . '\'';
    }
}