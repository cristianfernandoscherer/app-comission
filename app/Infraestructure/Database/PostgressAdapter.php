<?php

namespace App\Infraestructure\Database\Connection;

use App\Infraestructure\Database\Connection;

class PostgressAdapter implements Connection
{
    public $connection;

    public function __construct()
    {
        $connString = sprintf(
            "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            "db",
            "5432",
            "report",
            "postgres",
            "12345"
        );

        $this->connection = new \PDO($connString);
    }
    public function query(string $sql, $data)
    {
        $smtp = $this->connection->prepare($sql);

        foreach ($data as $key => $value) {
            $smtp->bindValue($key, $value);
        }

        return $smtp->execute();
    }

    public function close()
    {
        return $this->connection = null;
    }
}
