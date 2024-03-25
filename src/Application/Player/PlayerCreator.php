<?php

declare(strict_types=1);

namespace TableDragon\Application\Player;

use TableDragon\Domain\Player\Player;
use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Infrastructure\Shared\Uuid;

final class PlayerCreator
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository,
        private readonly Uuid $uuid
    ) {}

    public function __invoke(
        string $name,
        string $surname,
        string $number,
        int $category_id,
    ): Player
    {
        $newUuid = $this->uuid->makeUuid();
        // @todo render category object before instance creation
        $player = new Player($newUuid, $name, $surname, $number, $category_id);
        $this->playerRepository->saveObject($player);

        return $player;
    }
}