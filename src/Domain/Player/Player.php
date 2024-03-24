<?php

declare(strict_types=1);

namespace TableDragon\Domain\Player;

use TableDragon\Domain\Category\Category;

final class Player
{
    private string $id;
    private readonly string $name;
    private readonly string $surname;
    private readonly string $number;
    private readonly Category $category;

    public function __construct(string $id, string $name, string $surname, string $number = null, Category $category = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->number = $number;
        $this->category = $category;
    }

    public function getId(): string
    {
        return $this->id;
    }
}