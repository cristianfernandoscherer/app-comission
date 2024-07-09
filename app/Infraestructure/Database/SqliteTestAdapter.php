<?php

namespace App\Infraestructure\Database;

use App\Infraestructure\Database\Connection;

class SqliteTestAdapter implements Connection
{
    public $connection;

    public function __construct()
    {
        $this->connection = new \PDO("sqlite::memory:");

        $createTable = $this->connection->prepare(
            'CREATE TABLE IF NOT EXISTS congressperson (
                id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                birthdate DATE NOT NULL,
                phone TEXT NOT NULL,
                cpf TEXT NOT NULL,
                education TEXT NOT NULL,
                photo TEXT NULL,
                federated_unit TEXT NOT NULL,
                political_party TEXT NOT NULL
            )'
        );
        $createTable->execute();

        $smtp = $this->connection->prepare(
            'INSERT INTO congressperson VALUES (:id, :name, :email, :birthdate, :phone, :cpf, :education, :photo, :federated_unit, :political_party)'
        );

        $smtp->execute([
            'id' => 1,
            'name' => 'Márcio Abaco',
            'email' => 'marcio.abaco@gmail.com',
            'birthdate' => '2000-09-23',
            'phone' => '51997782137',
            'cpf' => '46068084035',
            'education' => 'Ensino Superior Completo',
            'photo' => null,
            'federated_unit' => 'RS',
            'political_party' => 'PSOL',
        ]);

        $smtp->execute([
            'id' => 2,
            'name' => 'Neiva Rios',
            'email' => 'neiva.rios@gmail.com',
            'birthdate' => '1999-09-15',
            'phone' => '51996682137',
            'cpf' => '03692275064',
            'education' => 'Ensino Superior Incompleto',
            'photo' => null,
            'federated_unit' => 'SC',
            'political_party' => 'PT',
        ]);
    }

    public function query(string $sql, $data, $isSelect = false)
    {
        $smtp = $this->connection->prepare($sql);
        $result = $smtp->execute($data);
        return ($isSelect) ? $smtp->fetchAll() : $result;
    }

    public function close()
    {
        return $this->connection = null;
    }
}
