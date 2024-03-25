<?php

declare(strict_types=1);

namespace TableDragon\Domain\Category;

final class Category
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $description;

    public function __construct(string $name, string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }
}