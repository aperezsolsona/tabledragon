<?php

declare(strict_types=1);

namespace TableDragon\Domain\Player;

interface PlayerRepositoryInterface
{
    public function findOneBy(array $criteria): ?object;

    public function findAll(): array;

    public function saveObject(Player $player): void;
}