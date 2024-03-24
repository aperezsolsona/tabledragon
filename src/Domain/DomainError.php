<?php

declare(strict_types=1);

namespace TableDragon\Domain;

use DomainException;

abstract class DomainError extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    abstract protected function errorMessage(): string;
}
