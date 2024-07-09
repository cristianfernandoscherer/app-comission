<?php

namespace App\Domain\Entity;

use DateTime;
use Exception;

class Congressperson
{
    public ?int $id;
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
        string $name,
        string $email,
        DateTime $birthdate,
        string $phone,
        string $cpf,
        string $education,
        string $photo,
        string $federatedUnit,
        string $politicalParty,
        ?int $id = null,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->cpf = $cpf;
        $this->education = $education;
        $this->photo = $photo;
        $this->federatedUnit = $federatedUnit;
        $this->politicalParty = $politicalParty;
        $this->id = $id;
        $this->isValid();
    }

    private function isValid()
    {
        if (empty($this->name)) {
            throw new Exception('Name is required');
        }

        if (empty($this->cpf)) {
            throw new Exception('CPF is required');
        } else if (!$this->isValidCPF($this->cpf)) {
            throw new Exception('Invalid CPF');
        }

        if (empty($this->phone)) {
            throw new Exception('Phone is required');
        }

        if (empty($this->email)) {
            throw new Exception('Email is required');
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email');
        }

        if (empty($this->birthdate)) {
            throw new Exception('Birthdate is required');
        }

        if (empty($this->federatedUnit)) {
            throw new Exception('Federated Unit is required');
        }

        if (empty($this->politicalParty)) {
            throw new Exception('Political Party is required');
        }
    }

    private function isValidCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}
