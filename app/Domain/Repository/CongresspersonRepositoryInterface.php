<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Congressperson;
use App\Domain\Repository\RepositoryInterface;

interface CongresspersonRepositoryInterface extends RepositoryInterface
{
    public function find(int $id): Congressperson;
}
