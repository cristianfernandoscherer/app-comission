<?php

namespace App\Infraestructure\Repository;

use App\Domain\Repository\CongresspersonRepositoryInterface;
use App\Domain\Entity\Congressperson;
use App\Infraestructure\Database\Connection;

use DateTime;

class CongresspersonRepository implements CongresspersonRepositoryInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function find(int $id): Congressperson
    {
        $query = "SELECT * FROM congressperson WHERE id =:id";
        $params = array(":id" => $id);
        $result = $this->connection->query($query, $params, true);

        if (!empty($result)) {
            $firstCongressperson = $result[0];

            $datetime = new DateTime();
            $birthdate = $datetime->createFromFormat('Y-m-d', $firstCongressperson['birthdate']);

            return new Congressperson(
                $firstCongressperson['name'],
                $firstCongressperson['email'],
                $birthdate,
                $firstCongressperson['phone'],
                $firstCongressperson['cpf'],
                $firstCongressperson['education'],
                (string)$firstCongressperson['photo'],
                $firstCongressperson['federated_unit'],
                $firstCongressperson['political_party'],
                $firstCongressperson['id']
            );
        }

        return null;
    }
}
