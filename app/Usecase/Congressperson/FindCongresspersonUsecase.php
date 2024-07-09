<?php

namespace App\Usecase\Congressperson;

use App\Domain\Repository\CongresspersonRepositoryInterface;
use App\Infraestructure\Repository\CongresspersonRepository;
use DateTime;

class FindCongresspersonUsecase
{
    private CongresspersonRepositoryInterface $repository;

    public function __construct(CongresspersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(InputFindCongresspersonDto $input): OutputFindCongresspersonDto
    {
        $congressperson = $this->repository->find($input->id);

        return new OutputFindCongresspersonDto(
            $congressperson->id,
            $congressperson->name,
            $congressperson->email,
            $congressperson->birthdate,
            $congressperson->phone,
            $congressperson->cpf,
            $congressperson->education,
            $congressperson->photo,
            $congressperson->federatedUnit,
            $congressperson->politicalParty
        );
    }
}
