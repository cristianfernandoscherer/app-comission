<?php

namespace App\Usecase\Congressperson;

class InputFindCongresspersonDto
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
