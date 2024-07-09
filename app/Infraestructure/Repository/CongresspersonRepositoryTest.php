<?php

namespace App\Infraestructure\Repository;

use PHPUnit\Framework\TestCase;
use App\Infraestructure\Database\SqliteTestAdapter;

class CongresspersonRepositoryTest extends TestCase
{
    public $connection;
    public $repository;

    protected function setUp(): void
    {
        $this->connection = new SqliteTestAdapter();
        $this->repository = new CongresspersonRepository($this->connection);
    }

    public function testFind()
    {
        $result = $this->repository->find(1);

        $this->assertEquals($result->id, 1, 'Id should be 1');
        $this->assertEquals($result->name, 'Márcio Abaco', 'Name should be Márcio Abaco');
        $this->assertEquals($result->email, 'marcio.abaco@gmail.com', 'Email should be marcio.abaco@gmail.com');
        $this->assertEquals($result->birthdate->format('Y-m-d'), '2000-09-23', 'Birthdate should be 2000-09-23');
        $this->assertEquals($result->phone, '51997782137', 'Phone should be 51997782137');
        $this->assertEquals($result->cpf, '46068084035', 'Cpf should be 02171614089');
        $this->assertEquals($result->education, 'Ensino Superior Completo', 'Education should be Ensino Superior Completo');
        $this->assertEquals($result->photo, null, 'Photo should be null');
        $this->assertEquals($result->federatedUnit, 'RS', 'FederatedUnit should be RS');
        $this->assertEquals($result->politicalParty, 'PSOL', 'PoliticalParty should be PSOL');
    }
}
