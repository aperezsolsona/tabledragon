<?php

declare(strict_types=1);

namespace TableDragon\Application\Player;

use TableDragon\Application\Category\CategoryFinder;
use TableDragon\Domain\Player\Player;
use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Infrastructure\Shared\Uuid;

final class PlayerCreator
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository,
        private readonly CategoryFinder $categoryFinder,
        private readonly Uuid $uuid
    ) {}

    public function __invoke(
        string $name,
        string $surname,
        string $number,
        int $category_id,
    ): Player
    {
        $category = $this->categoryFinder->__invoke($category_id);
        $newUuid = $this->uuid->makeUuid();
        $player = new Player($newUuid, $name, $surname, $number, $category);
        $this->playerRepository->saveObject($player);

        return $player;
    }
}