<?php

namespace core\db;

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

    public function execute(string $sql): bool|int
    {
        return $this->query($sql);
    }

    /**
     * @param string $sql
     * @return bool|\mysqli_result|void
     */
    private function query(string $sql)
    {
        $this->connect();
        $query = mysqli_query($this->connection, $sql);
        if ($query === false) {
            die('query error: ' . mysqli_error($this->connection));
        }
        return $query;
    }
}