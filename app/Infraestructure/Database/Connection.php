<?php

declare(strict_types=1);

namespace App\Infraestructure\Database;

interface Connection
{
    public function query(string $sql, $data);
    public function close();
}
