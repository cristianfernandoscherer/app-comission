<?php

namespace App\Usecase\Congressperson;

use DateTime;

class OutputFindCongresspersonDto
{
    public int $id;
    public string $name;
    public string $email;
    public DateTime $birthdate;
    public string $phone;
    public string $cpf;
    public string $education;
    public string $photo;
    public string $federatedUnit;
    public string $politicalParty;

    public function __construct(
        int $id = null,
        string $name,
        string $email,
        DateTime $birthdate,
        string $phone,
        string $cpf,
        string $education,
        string $photo,
        string $federatedUnit,
        string $politicalParty
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->cpf = $cpf;
        $this->education = $education;
        $this->photo = $photo;
        $this->federatedUnit = $federatedUnit;
        $this->politicalParty = $politicalParty;
    }
}
