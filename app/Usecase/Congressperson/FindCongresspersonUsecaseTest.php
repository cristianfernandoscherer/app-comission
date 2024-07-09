<?php

namespace App\Usecase\Congressperson\find;

use PHPUnit\Framework\TestCase;
use App\Usecase\Congressperson\FindCongresspersonUsecase;
use App\Infraestructure\Database\SqliteTestAdapter;
use App\Infraestructure\Repository\CongresspersonRepository;
use App\Usecase\Congressperson\InputFindCongresspersonDto;

class FindCongresspersonUsecaseTest extends TestCase
{
    public function testExecute()
    {
        $connection = new SqliteTestAdapter();
        $repository = new CongresspersonRepository($connection);
        $usecase = new FindCongresspersonUsecase($repository);

        $record = $usecase->execute(new InputFindCongresspersonDto(1));
        $this->assertNotEmpty($record, "Record expected");
        $this->assertEquals($record->id, 1, 'Id should be 1');
        $this->assertEquals($record->name, 'Márcio Abaco', 'Name should be Márcio Abaco');
        $this->assertEquals($record->email, 'marcio.abaco@gmail.com', 'Email should be marcio.abaco@gmail.com');
        $this->assertEquals($record->birthdate->format('Y-m-d'), '2000-09-23', 'Birthdate should be 2000-09-23');
        $this->assertEquals($record->phone, '51997782137', 'Phone should be 51997782137');
        $this->assertEquals($record->cpf, '46068084035', 'Cpf should be 02171614089');
        $this->assertEquals($record->education, 'Ensino Superior Completo', 'Education should be Ensino Superior Completo');
        $this->assertEquals($record->photo, null, 'Photo should be null');
        $this->assertEquals($record->federatedUnit, 'RS', 'FederatedUnit should be RS');
        $this->assertEquals($record->politicalParty, 'PSOL', 'PoliticalParty should be PSOL');
    }
}
