<?php

namespace TableDragon\Domain\Category\Exception;

use TableDragon\Domain\DomainError;

class CategoryNotFound extends DomainError
{
    private int $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        return sprintf('The category with id <%s> was not found', $this->categoryId);
    }
}