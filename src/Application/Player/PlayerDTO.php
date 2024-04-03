<?php

namespace TableDragon\Application\Player;

class PlayerDTO
{
    public readonly ?string $id;
    public readonly string $name;
    public readonly string $surname;
    public readonly string $number;
    public readonly int $categoryId;

    public function __construct(string $name,
                                string $surname,
                                string $number,
                                int    $categoryId,
                                string $id = null
    ){
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->number = $number;
        $this->categoryId = $categoryId;
    }
}