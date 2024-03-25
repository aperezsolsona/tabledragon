<?php

declare(strict_types=1);

namespace TableDragon\Domain\Category;

final class Category
{
    private int $id;
    private readonly string $name;
    private readonly string $description;

    public function __construct(string $name, string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }
}