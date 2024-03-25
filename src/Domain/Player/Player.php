<?php

declare(strict_types=1);

namespace TableDragon\Domain\Player;

use TableDragon\Domain\Category\Category;

final class Player
{
    public readonly string $id;
    public readonly string $name;
    public readonly string $surname;
    public readonly string $number;
    public readonly Category $category;

    public function __construct(string $id, string $name, string $surname, string $number = null, Category $category = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->number = $number;
        $this->category = $category;
    }
}